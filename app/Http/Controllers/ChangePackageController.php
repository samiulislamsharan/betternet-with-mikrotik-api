<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class ChangePackageController extends Controller
{
    public function edit(User $user)
    {
        $packages = Package::orderBy('name')->get();
        return view('packages.change', compact('packages', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $package = Package::where("id", $request->package_name)->firstOrFail();

        try {
            $client = new Client([
                "host" => get_setting('router_ip'),
                "user" => get_setting('router_username'),
                "pass" => get_setting('router_password'),
            ]);

            $query = new Query("/ppp/secret/set");
            $query->equal("numbers", $user->name);
            $query->equal("profile", $package->name);
            $client->query($query)->read();
        } catch (\Exception $e) {
            return back()->with("error", __("Mikrotik connection fails"));
        }

        $user->detail->update([
            "package_name" => $package->name,
            "package_price" => $package->price,
            "package_start" => Carbon::now(),
        ]);

        return redirect('users');
    }
}
