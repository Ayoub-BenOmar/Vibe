<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'bio',
        'profile_photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sentRequests(){
        return $this->hasMany(friend_request::class, 'sender_id');
    }

    public function receivedRequests(){
        return $this->hasMany(friend_request::class, 'receiver_id');
    }

    public function friends(){
        return $this->whereHas('sentRequests', function ($q) {
            $q->where('receiver_id', Auth::id())
              ->where('status', 'accepted');
        })
        ->orWhereHas('receivedRequests', function ($q) {
            $q->where('sender_id', Auth::id())
              ->where('status', 'accepted');
        });
    }

}
