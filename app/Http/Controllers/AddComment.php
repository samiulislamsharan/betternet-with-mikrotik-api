<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AddComment extends Controller
{
    public function __invoke(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = auth()->id();
        $comment->ticket_id = $request->ticket_id;
        $comment->save();

        return back();
    }
}
