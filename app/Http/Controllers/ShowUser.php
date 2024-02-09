<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ShowUser extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('id', $request->user)->firstOrFail();

        $pdf = PDF::loadview('reports.single', compact('user'));
        return $pdf->download( config('app.name') . ' User detail ' . date('dmY') . ('.pdf'));
    }
}
