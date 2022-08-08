<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'sender', 'message'];

    public static function getChat($roomID){
        return DB::table('chats')
        ->join('users', 'users.id', '=', 'chats.sender')
        ->where('chat_room_id', $roomID)
        ->select('chats.*', 'users.name', DB::raw(Auth::user()->id." as user_id") )
        ->get();
    }

    public function chat_rooms(){
        return $this->belongsTo(ChatRoom::class);
    }

    public function senders(){
        return $this->belongsTo(User::class, 'sender', 'id');
    }
}
