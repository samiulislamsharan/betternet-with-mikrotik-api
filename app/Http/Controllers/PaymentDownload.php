<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PaymentDownload extends Controller
{
    public function __invoke()
    {
        $payments = Payment::with(['user', 'billing'])->get();

        $pdf = PDF::loadview('reports.payment', compact('payments'));
        return $pdf->download( config('app.name') . ' Payment History ' . date('dmY') . ('.pdf'));
    }
}
