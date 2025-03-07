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
        $userIds = $friends->push(auth()->id());
        
        $posts = Post::whereIn('user_id', $userIds)
            ->with('user')
            ->latest('created_at')
            ->get();
        
        return view('dashboard', compact('posts') );
    }

    public function edit(Post $post)
    {
        // Ensure the authenticated user can only edit their own posts
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to edit this post.');
        }

        return view('edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not allowed to update this post.');
        }

        $request->validate([
            'content' => ['required', 'string', 'max:1000'],
            'post_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $post->content = $request->input('content');

        if($request->hasFile('post_pic')){
            $image = $request->file('post_pic');
            $imageName = time() . '.' . $image->extension();
            $imagePath = $request->file('post_pic')->storeAs('uploads', $imageName, 'public');

            $post->post_pic = $imagePath;
        };
        $post->save(); 

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You are not allowed to delete this post.');
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

}
