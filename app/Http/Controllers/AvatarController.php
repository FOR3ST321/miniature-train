<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Avatar;
use App\Models\Payment;
use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AvatarController extends Controller
{
    public function useAvatar(Request $request){
        $user = User::find(Auth::user()->id);
        if($user->is_incognito){
            Alert::error('You are on incognito mode!', '');
            return redirect()->back();
        }

        User::where('id', Auth::user()->id)->update([
            'avatar_id' => $request->avatar_id
        ]);
        Alert::success('Avatar Changed!', '');
        return redirect()->back();
    }

    public function buyAvatar(Request $request){
        $user = User::find(Auth::user()->id);
        $avatar = Avatar::find($request->avatar_id);
        if($avatar->price > $user->coin){
            Alert::error('Not enough coins!', 'Please top up your coins!');
            return redirect()->back();
        }

        User::where('id', Auth::user()->id)->update([
            'coin' => $user->coin - $avatar->price
        ]);

        UserAvatar::create([
            'user_id' => $user->id,
            'avatar_id' => $avatar->id,
            'is_a_gift' => false,
            'gift_giver' => null
        ]);

        Payment::create([
            'user_id' => Auth::user()->id,
            'payment_type' => 'avatar',
            'amount' => $avatar->price,
            'avatar_id' => $avatar->id,
            'is_a_gift' => false,
        ]);

        Alert::success('Avatar Purchased!', '');
        return redirect()->back();
    }

    public function giveAvatar(Request $request){
        $avatar = Avatar::find($request->avatar_id);
        $user = User::find(Auth::user()->id);
        
        $friend = User::find($request->friend);
        $friend_ava = UserAvatar::where('user_id', $friend->id)->where('avatar_id', $avatar->id)->first();
        
        //kalau ud punya avatar
        if($friend_ava != null){
            Alert::error('Your friend already has this avatar!', '');
            return redirect()->back();
        }

        if($avatar->price > $user->coin){
            Alert::error('Not enough coins!', 'Please top up your coins!');
            return redirect()->back();
        }

        User::where('id', Auth::user()->id)->update([
            'coin' => $user->coin - $avatar->price
        ]);

        UserAvatar::create([
            'user_id' => $friend->id,
            'avatar_id' => $avatar->id,
            'is_a_gift' => true,
            'gift_giver' => Auth::user()->id
        ]);

        Payment::create([
            'user_id' => Auth::user()->id,
            'payment_type' => 'avatar',
            'amount' => $avatar->price,
            'avatar_id' => $avatar->id,
            'is_a_gift' => true,
        ]);

        Alert::success('You Give an Avatar!', $friend->name.' Received the avatar.');
        return redirect('/avatar');
    }
}
