<?php

namespace App\Models;

use App\Models\User;
use App\Models\Avatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_type', 'amount', 'avatar_id', 'is_a_gift', 'payment_method'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function avatar(){
        return $this->belongsTo(Avatar::class);
    }
}
