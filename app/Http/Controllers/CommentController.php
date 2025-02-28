<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }
}
