<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function storeLikes(Post $post){
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already liked this post.');
        }
    
        $like = new Like();
        $like->user_id = auth()->id(); 
        $like->post_id = $post->id; 
        $like->save();
    
        return back()->with('success', 'Post liked successfully.');
    }
}
