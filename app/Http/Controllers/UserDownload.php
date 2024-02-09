<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class UserDownload extends Controller
{
    public function __invoke()
    {
        $users = User::where('role', 'user')->with('detail')->get();

        $pdf = PDF::loadview('reports.users', compact('users'));
        return $pdf->download( config('app.name') . ' User Report ' . date('dmY') . ('.pdf'));
    }
}
