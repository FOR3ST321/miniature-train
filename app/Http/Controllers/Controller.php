<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
        return view('home', [
            'user' => User::where('is_incognito', 0)->orderByDesc('id')->paginate(9),
            'active' => 'home'
        ]);
    }

    public function login(){
        return view('login', ['active' => 'login']);
    }

    public function friend(){
        return view('friends', [
            'friends' => User::where('is_incognito', 0)->orderByDesc('id'),
            'active' => 'friends'
        ]);
    }

    public function message(){
        return view('message', [
            'rooms' => ChatRoom::where('friend_1', Auth::user()->id)->orwhere('friend_2', Auth::user()->id)->orderByDesc('id')->get(),
            'active' => 'message'
        ]);
    }

    public function chatroom(){
        return view('chatroom', [
            'room' => ChatRoom::where('id', request()->id)->orderByDesc('created_at')->first(),
            'active' => ''
        ]);
    }
}
