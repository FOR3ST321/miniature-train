<?php

namespace App\Models;

use App\Models\Chat;
use App\Models\Hobby;
use App\Models\Avatar;
use App\Models\Friend;
use App\Models\Payment;
use App\Models\ChatRoom;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'age',
        'coin',
        'instagram_link',
        'phone',
        'address',
        'avatar_id',
        'has_pay',
        'regist_price',
        'is_incognito',
        'incognito_bear',
    ];

    public static function getSearchData($query){
        global $queries;
        $queries = $query;
        return User::where('name', 'like', '%'.$query.'%')->where('is_incognito', 0)
        ->orWhereHas('hobbies', function($query){
            global $queries;
            $query->where('hobby', 'like', '%'.$queries.'%');
        })->orderByDesc('id')->paginate(9);
    }

    public function hobbies(){
        return $this->hasMany(Hobby::class);
    }

    public function avatar(){
        return $this->belongsTo(Avatar::class);
    }

    public function user_avatars(){
        return $this->hasMany(Avatar::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function friends(){
        return $this->hasMany(Friend::class);
    }

    public function chat_rooms(){
        return $this->hasMany(ChatRoom::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }
}
