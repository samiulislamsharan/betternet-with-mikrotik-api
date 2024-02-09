<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class CloseTicket extends Controller
{
    public function __invoke(Request $request)
    {
        $ticket = Ticket::firstWhere('id', $request->ticket_id);
        $ticket->status = 'Close';
        $ticket->save();
        return back();
    }
}
