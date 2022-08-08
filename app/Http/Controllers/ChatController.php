<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request){
        Chat::create([
            'chat_room_id' => $request->room_id,
            'sender' => Auth::user()->id,
            'message' => $request->message
        ]);
        return response()->json(['success'=>$request->message]);
    }

    public function loadMessage(Request $request){
        $messages = Chat::getChat($request->room_id);
        return response()->json(['data'=>$messages]);
    }
}
