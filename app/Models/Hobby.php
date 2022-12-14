<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hobby extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hobby', 'photo', 'description'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
