<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index');
    }

    public function create($param)
    {
        if (auth()->user()->isUser()){
            $bill = Billing::where('id', $param)->firstOrFail();

            return view('payments.create', compact('bill'));
        }

        return redirect('dashboard');
    }

    public function store(Request $request)
    {
        $bill = Billing::firstWhere('invoice', $request->invoice);

        $payment = new Payment();
        $payment->user_id = $bill->user_id;
        $payment->billing_id = $bill->id;
        $payment->invoice = $bill->invoice;
        $payment->package_price = $bill->package_price;
        $payment->payment_method = $request->payment_method;
        $payment->save();

        return back();
    }

    public function process(Request $request)
    {
        $user = $request->user();
        $dollar_to_cent = $request->amount;

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($request->payment_method);

        $user->charge($dollar_to_cent, $request->payment_method);

        // Handle successful payment
        $bill = Billing::where('id', $request->bill)->firstOrFail();

        $payment = new Payment();
        $payment->user_id = $bill->user_id;
        $payment->billing_id = $bill->id;
        $payment->invoice = $bill->invoice;
        $payment->package_price = $bill->package_price;
        $payment->payment_method = 'Stripe';
        $payment->save();

        return redirect('payment')->with('success', 'Payment successful!');
    }
}
