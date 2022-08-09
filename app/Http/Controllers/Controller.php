<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Friend;
use App\Models\ChatRoom;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
        $user = User::where('is_incognito', 0);
        if(Auth::check()){
            $user = $user->where('id', '!=', Auth::user()->id);
        }
        $user = $user->orderByDesc('id');

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

    public function register(){
        return view('register', ['active' => '']);
    }

    public function payRegist(){
        return view('payRegist', ['active' => '', 'user' => User::find(request()->id)]);
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
    
    public function avatar(Request $request){
        $avatar = DB::table('avatars')->select('avatars.*', 'user_avatars.user_id', 'user_avatars.avatar_id')->where('avatars.id' , '!=', 1)->leftJoin('user_avatars', function ($join){
            $join->on('avatars.id', '=', 'user_avatars.avatar_id')
            ->on('user_avatars.user_id', '=', DB::raw(Auth::user()->id));
        })->paginate(20);
        
        //DB::table('avatars')->leftJoin('user_avatars', 'avatars.id', '=', 'user_avatars.avatar_id')

        return view('avatar', [
            'avatars' => $avatar,
            'active' => 'avatar'
        ]);
    }

    public function giveAvatar(Request $request){
        $friend = Friend::where('is_confirmed', 1)->where('friend_1' , Auth::user()->id)->orWhere('friend_2', Auth::user()->id);
        $user = User::find(Auth::user()->id);
        $avatar = Avatar::find($request->id);


        if($avatar->price > $user->coin){
            Alert::error('Not enough coins!', 'Please top up your coins!');
            return redirect()->back();
        }

        if($friend->count() == 0){
            Alert::error('You have no friend to give!', 'Search for a friend on home / search menu!');
            return redirect()->back();
        }

        return view('giveAvatar', [
            'avatar' => Avatar::find($request->id),
            'friendList' => $friend->get(),
            'active' => 'avatar'
        ]);
    }

    public function topup(){
        return view('topup', [
            'active' => ''
        ]);
    }

    public function profile(){
        return view('profile', [
            'user' => User::find(Auth::user()->id),
            'myAvatar' => DB::table('user_avatars')->join('avatars', 'avatars.id', '=', 'user_avatars.avatar_id')->where('user_avatars.user_id', Auth::user()->id)->where('avatars.id', '!=', 1)->get(),
            'active' => ''
        ]);
    }

    public function incognito(){
        return view('incognito', [
            'active' => ''
        ]);
    }
}
