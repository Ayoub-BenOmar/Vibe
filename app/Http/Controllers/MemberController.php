<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\User;

class MemberController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->limit(10)
            ->get();
        return view('users', compact('users'));
    }

    public function show(User $user)
    {
        // Fetch the user's posts with pagination
        $posts = $user->posts()->latest()->get();

        return view('user_profile', compact('user', 'posts'));
    }

}
