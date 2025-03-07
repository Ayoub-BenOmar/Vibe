<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Friend_request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Eloquent\Model;


class FriendRequestController extends Controller
{
    public function send_request($user_id){
        $sender_id = Auth::user()->id;
        $receiver_id = $user_id;

        $exist_user = friend_request::where('sender_id', $sender_id)
            ->where('receiver_id',$receiver_id)
            ->where('status', ['pending', 'accepted'])
            ->exists();

        if($exist_user){
            return back()->with("error", "you have already accepted this request");
        }

        if(!$sender_id){
//            echo("You can't send request, you should be logged in");
            return back()->with("error", "You can't send request, you should be logged in");
        }

        if($sender_id == $receiver_id){
//            echo("You can't send request to yourself");
            return back()->with("error", "You can't send request to yourself");
        }

         DB::table('friend_request')->insert([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
        ]);
        return back()->with("success", "Request sent");
    }

    public function show_requests(){
        $requests = friend_request::where('friend_request.receiver_id', Auth::id())
            ->where('friend_request.status', 'pending')
            ->join('users', 'friend_request.sender_id', '=', 'users.id')
            ->select('friend_request.*', 'users.name as sender_name', 'users.username as sender_username', 'users.profile_photo as sender_image', 'users.id as sender_id')
            ->get();
//        dd($requests);
        return view('requests', compact('requests'));
    }

    public function accept_request($user_id){
        DB::table('friend_request')->where('receiver_id', Auth::id())
            ->where('sender_id', $user_id)
            ->update(['status' => 'accepted']);
        return back()->with("success", "request accepted");
    }

    public function reject_request($user_id){
        DB::table('friend_request')->where('receiver_id', Auth::id())
            ->where('sender_id', $user_id)
            ->update(['status' => 'rejected']);
        return back()->with('success', 'request rejected');
    }
}
