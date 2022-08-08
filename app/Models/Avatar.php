<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image'];

    public function user(){
        return $this->hasMany(User::class);
    }
}
