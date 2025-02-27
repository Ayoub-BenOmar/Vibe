<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $fillable =[
        'content',
        'user_id',
        'post_pic',
    ];

    
}
