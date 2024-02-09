<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BillingDownload extends Controller
{
    public function __invoke()
    {
        $bills = Billing::with('user')->get();

        $pdf = PDF::loadview('reports.billing', compact('bills'));
        return $pdf->download( config('app.name') . ' Billing History ' . date('dmY') . ('.pdf'));
    }
}
