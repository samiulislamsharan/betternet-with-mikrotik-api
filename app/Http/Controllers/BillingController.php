<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        return view('billing.index');
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        $users = User::where('role', 'user')
            ->with('detail')
            ->whereHas('detail', function (Builder $query) {
                $query->where('status', 'active');
            })->orderBy('name')->get();

        return view('billing.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (is_array($request->user_id) || is_object($request->user_id))
        {
            foreach ($request->user_id as $key => $val) {
                $billing = new Billing();
                if (is_array($request->checked) && in_array($val, $request->checked, true)) {
                    $user = User::where('id', $val)->first();
                    $billing->invoice = $billing->generateRandomNumber();
                    $billing->package_name = $user->detail->package_name;
                    $billing->package_price = $user->detail->package_price;
                    $billing->package_start = Carbon::now();
                    $billing->user_id = $user->id;
                    $billing->save();
                }
            }
        }
        return redirect('/billing');
    }
}
