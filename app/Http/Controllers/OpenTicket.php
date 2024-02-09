<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class OpenTicket extends Controller
{
    public function __invoke(Request $request)
    {
        $ticket = Ticket::firstWhere('id', $request->ticket_id);
        $ticket->status = 'Open';
        $ticket->save();
        return back();
    }
}
