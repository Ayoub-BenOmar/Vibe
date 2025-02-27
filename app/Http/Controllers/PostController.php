<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost(Request $request){
        $request->validate([
            'content' => ["required", "string", "max:255"],
            'post_pic' => ["image", 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);
    
        $imagePath = null;
        if ($request->hasFile('post_pic')) {
            $imagePath = $request->file('post_pic')
                ->storeAs('uploads', $request->file('post_pic')
                ->getClientOriginalName(), 'public');
        }
        
        $posts = Post::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_pic' => $imagePath ? $imagePath : null,
        ]);
        
        return back()->with('success', 'Your post has been published');
    }

    public function showPosts()
    {
        $friends = auth()->user()->friends()->pluck('id');
        $posts = Post::whereIn('user_id', $friends)
            ->with('user')
            ->latest('created_at')
            ->get();
            
        return view('dashboard', compact('posts'));
    }

}
