<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $friends = auth()->user()->friends()->pluck('id');
        $userIds = $friends->push(auth()->id());
        
        $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->whereIn('posts.user_id', $userIds)
        ->select('posts.*', 'users.name as name', 'users.username as username', 'users.profile_photo as profile_photo') // Select the columns you need
        ->withCount('likes')
        ->with(['user', 'likes', 'comments.user'])
        ->latest('posts.created_at')
        ->get();
        return view('dashboard',compact('posts'));
    }
}
