<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index');
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->priority = $request->priority;
        $ticket->status = 'Open';
        $ticket->user_id = auth()->id();
        $ticket->number = $ticket->generateRandomNumber();
        $ticket->save();

        return redirect('ticket');
    }

    public function show(Ticket $ticket)
    {
        $comments = Comment::where('ticket_id', $ticket->id)->with('user')->get();

        return view('tickets.show', compact('ticket', 'comments'));
    }
}
