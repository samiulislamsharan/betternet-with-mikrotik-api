<?php

namespace App\Http\Controllers;

use App\Classes\Mikrotik;
use App\Models\Billing;
use App\Models\Detail;
use App\Models\Package;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RouterOS\Client;
use RouterOS\Query;
use App\Models\User;

class UserController extends Controller
{
    private $routerConnection;

    public function __construct()
    {
        $this->routerConnection = new Mikrotik();
    }

    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        $users = User::with('detail')->where('role', 'user')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        $packages = Package::orderBy('name')->get();
        return view('users.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6|confirmed",
            "address" => "required",
            "phone" => "required",
            "dob" => "required",
            "package_name" => "required",
            "router_password" => "required",
        ]);

        $settings = Setting::firstOrFail();
        $package = Package::where("id", $request->package_name)->firstOrFail();

        try {
            $client = new Client([
                "host" => $settings->router_ip,
                "user" => $settings->router_username,
                "pass" => $settings->router_password,
            ]);

            $query = new Query("/ppp/secret/add");
            $query->equal("name", $request->name);
            $query->equal("password", $request->router_password);
            $query->equal("service", 'any');
            $query->equal("profile", $package->name);

            $client->query($query)->read();
        } catch (\Exception $e) {
            return back()->with("error", __("Mikrotik connection fails"));
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'user';
        $user->password = Hash::make($request->password);
        $user->save();

        $details = new Detail();
        $details->phone = $request->phone;
        $details->address = $request->address;
        $details->dob = $request->dob;
        $details->pin = $request->pin;
        $details->router_password = $request->router_password;
        $details->package_name = $package->name;
        $details->package_price = $package->price;
        $details->due = $package->price;
        $details->status = 'active';
        $details->package_start = Carbon::now();
        $details->user_id = $user->id;
        $details->save();

        $billing = new Billing();
        $billing->invoice = $billing->generateRandomNumber();
        $billing->package_name = $details->package_name;
        $billing->package_price = $details->package_price;
        $billing->package_start = $details->package_start;
        $billing->user_id = $user->id;
        $billing->save();

        return redirect("users")->with("success", __("User added successfully"));
    }

    public function show(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            "name" => "required",
            "password" => "nullable|min:6|confirmed",
            "address" => "required",
            "phone" => "required",
            "dob" => "required",
        ]);

        $user->name = $request->name;
        if (filled($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $details = Detail::firstWhere('user_id', $user->id);
        $details->phone = $request->phone;
        $details->address = $request->address;
        $details->dob = $request->dob;
        $details->pin = $request->pin;
        $details->save();

        return redirect("users")->with("success", __("User added successfully"));
    }
}
