<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
        $user = User::where('is_incognito', 0)->orderByDesc('id');

        if(request()->gender != null){
            $user = $user->where('gender', request()->gender);
        }

        return view('home', [
            'user' => $user->paginate(9),
            'active' => 'home'
        ]);
    }

    public function search(Request $request){
        $data = User::getSearchData($request->searchData);
        return view('search', [
            'data' => $data,
            'active' => ''
        ]);
    }

    public function login(){
        return view('login', ['active' => 'login']);
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

    public function userDetail(Request $request){
        $user = User::where('id', $request->id)->first();
        $friend = Friend::where([['friend_1', Auth::user()->id], ['friend_2', $user->id]])
        ->orWhere([['friend_2', Auth::user()->id], ['friend_1', $user->id]])->first();
        return view('userDetail', [
            'user' => $user,
            'friend' => $friend,
            'active' => ''
        ]);
    }
}
