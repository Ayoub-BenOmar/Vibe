<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class FriendRequestController extends Controller
{
    public function send_request($user_id){
        echo 'your reciever id is '.$user_id;
    }
}
