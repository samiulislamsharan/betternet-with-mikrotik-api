<?php

namespace App\Http\Controllers;

use App\Classes\Mikrotik;
use App\Models\Package;
use Illuminate\Http\Request;
use RouterOS\Query;

class PackageController extends Controller
{
    private $routerConnection;

    public function __construct()
    {
        $this->routerConnection = new Mikrotik();
    }

    public function index()
    {
        $packages = Package::orderBy('name')->get();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $client = (new Mikrotik)->checkConnection();
        if (!$client) {
            return back()->with('error', __('Unable to connect to Mikrotik router'));
        }
        $query = new Query("/ppp/profile/add");
        $query->equal("name", $request->name);
        $client->query($query)->read();

        $package = new Package();
        $package->fill($validated);
        $package->save();

        return redirect('packages')->with('success', __('Package successful added'));
    }

    public function show(Package $package)
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);

        $package->price = $validated['price'] ? $request->price : $package->price;
        $package->save();

        return redirect('packages')->with('success', __('Package successful added'));
    }
}
