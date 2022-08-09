<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FriendController extends Controller
{
    public function sendFriendReq(Request $request){
        Friend::create([
            'friend_1' => Auth::user()->id,
            'friend_2' => $request->user_id,
            'is_confirmed' => false
        ]);

        Alert::success('Friend Request Sent!', '');
        return redirect()->back();
    }

    public function acceptFriendReq(Request $request){
        Friend::find($request->friend_id)->update([
            'is_confirmed' => true
        ]);

        //bikin room
        ChatRoom::create([
            'friend_1' => $request->user_id,
            'friend_2' => Auth::user()->id,
        ]);

        Alert::success('Friend Request Accepted!', '');
        return redirect()->back();
    }

    public function cancelFriendReq(Request $request){
        Friend::find($request->friend_id)->delete();
        Alert::success('Friend Request '.$request->msg.'!', '');
        return redirect()->back();
    }
}
