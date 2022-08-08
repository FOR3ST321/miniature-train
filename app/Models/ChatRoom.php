<?php

namespace App\Models;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = ['friend_1', 'friend_2'];

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function friends_1(){
        return $this->belongsTo(User::class, 'friend_1', 'id');
    }

    public function friends_2(){
        return $this->belongsTo(User::class, 'friend_2', 'id');
    }
}
