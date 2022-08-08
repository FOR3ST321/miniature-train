<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'sender', 'message'];

    public function chat_rooms(){
        return $this->belongsTo(ChatRoom::class);
    }

    public function senders(){
        return $this->belongsTo(User::class, 'sender', 'id');
    }
}
