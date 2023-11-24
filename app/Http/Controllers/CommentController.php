<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
    function store(Request $request) {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();

        return redirect()->back();
    }
}
