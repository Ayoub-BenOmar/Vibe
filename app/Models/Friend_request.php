<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class friend_request extends Model
{
    //
    protected $table = 'friend_request';
    protected $fillable = ['sender_id', 'receiver_id'];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
