<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->isUser()) {
            $user = User::with('detail')->where('id', auth()->id())->firstOrFail();
            return view('dashboard2', compact('user'));
        }

        $totalPackages = Package::count();
        $totalBills = Billing::sum('package_price');
        $totalPayments  = Payment::sum('package_price');
        $totalUsers = User::where('role', 'user')->count();
        $openTickets = Ticket::where('status', 'Open')->count();
        $recentUsers = User::where('role', 'user')->with(['billing', 'detail'])->latest()->take(5)->get();
        $recentPayments = Payment::with('user')->latest()->take(5)->get();
        $recentTickets = Ticket::latest()->take(5)->get();
        $paymentsThisMonth = Payment::whereMonth('created_at', now()->month)->sum('package_price');
        $billsThisMonth = Billing::whereMonth('created_at', now()->month)->sum('package_price');
        $paymentsThisYear = Payment::whereYear('created_at', now()->year)->sum('package_price');
        $billsThisYear = Billing::whereYear('created_at', now()->year)->sum('package_price');

        $usersWithDueCount = User::where('role', 'user')->get()
            ->filter(function ($user) {
            return $user->due_amount($user->id) > 0;
        })->count();
        $usersWithDueList = User::where('role', 'user')->get()
            ->filter(function ($user) {
                return $user->due_amount($user->id) > 0;
            });

        // Fetch the monthly billing and payment data
        $billingData = Billing::whereYear('created_at', Carbon::now()->year)
            ->get()->groupBy(function ($billing) {
                return $billing->created_at->format('F');
            })->map(function ($billings) {
                return $billings->sum('package_price');
            });

        $paymentData = Payment::whereYear('created_at', Carbon::now()->year)
            ->get()->groupBy(function ($payment) {
                return $payment->created_at->format('F');
            })->map(function ($payments) {
                return $payments->sum('package_price');
            });

        // Fetch the daily billing and payment data for the current month
        $daysInMonth = Carbon::now()->daysInMonth;
        $dailyBillingData = [];
        $dailyPaymentData = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dailyBillingAmount = Billing::whereDate('created_at', Carbon::now()->year . '-' . Carbon::now()->month . '-' . $day)
                ->sum('package_price');

            $dailyPaymentAmount = Payment::whereDate('created_at', Carbon::now()->year . '-' . Carbon::now()->month . '-' . $day)
                ->sum('package_price');

            $dailyBillingData[] = $dailyBillingAmount;
            $dailyPaymentData[] = $dailyPaymentAmount;
        }

        return view('dashboard', compact(
            'totalUsers',
            'totalBills',
            'totalPayments',
            'paymentsThisMonth',
            'billsThisMonth',
            'recentPayments',
            'recentUsers',
            'totalPackages',
            'paymentsThisYear',
            'billsThisYear',
            'usersWithDueCount',
            'usersWithDueList',
            'openTickets',
            'billingData',
            'paymentData',
            'dailyBillingData',
            'dailyPaymentData',
            'recentTickets'
        ));
    }
}
