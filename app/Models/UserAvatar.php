<?php

namespace App\Models;

use App\Models\User;
use App\Models\Avatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAvatar extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'avatar_id', 'is_a_gift', 'gift_giver'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function avatar(){
        return $this->belongsTo(Avatar::class);
    }

    public function gift_givers(){
        return $this->belongsTo(User::class, 'gift_giver', 'id');
    }
}
