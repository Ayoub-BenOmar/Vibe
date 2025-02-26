<?php

namespace App\Http\Controllers;
use App\Models\Friend_request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class FriendsController extends Controller
{
    public function show_friends(){
        $friends = friend_request::where('friend_request.status', 'accepted')
            ->where('users.id', '!=', Auth::id())
            ->where(function ($query) {
                $query->where('friend_request.sender_id', Auth::id())
                    ->orWhere('friend_request.receiver_id', Auth::id());
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'friend_request.sender_id')
                    ->orOn('users.id', '=', 'friend_request.receiver_id');
            })
            ->select(
                'friend_request.id',
                'friend_request.status',
                'users.name as friend_name',
                'users.username as friend_username',
                'users.profile_photo as friend_image',
                'users.id as friend_id'
            )
            ->get();
        return view('friends', compact('friends'));
    }
}
