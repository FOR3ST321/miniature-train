<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function login(Request $request){
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($cred)){
            if(Auth::user()->has_pay){
                return redirect('/');
            }
            else{
                return redirect('/payRegist/'.Auth::user()->id);
            }
        }else{
            return redirect()->back()->withErrors(['msg' => 'Invalid Account']);
        }
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required',
            'age' => 'required|integer',
            'phone' => 'required|numeric|digits_between:12,15',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'instagram_link' => 'required|url|starts_with:https://www.instagram.com/',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'hobby_name'=> 'required|array|min:3',
            'hobby_name.*' => 'required|string|distinct|min:3',
            'hobby_description'=> 'required|array|min:3',
            'hobby_description.*' => 'required|string|distinct|min:8',
            'photo' => 'required|array|min:3',
            'photo.*' => 'required|image'
        ]);

        // dump($request->all());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->coin = 100;
        $user->instagram_link = $request->instagram_link;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->avatar_id = 1;
        $user->has_pay = false;
        $user->regist_price = rand(100000, 125000);
        $user->is_incognito = false;
        $user->incognito_bear = null;
        $user->save();

        $user_id = $user->id;
        $i = 0;
        foreach($request->file('photo') as $file){
            $name = time().$file->getClientOriginalName();
            $file->move('img/user_photo/', $name);  
            $path = '/img/user_photo/'.$name;
            Hobby::create([
                'user_id' => $user_id,
                'hobby' => $request->hobby_name[$i],
                'description' => $request->hobby_description[$i],
                'photo' => $path
            ]);
            $i++;
        }

        Alert::success('Account Created!', 'Please continue to the next step.');
        return redirect('/payRegist/'.$user_id);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function topup(Request $request){
        $user = User::find(Auth::user()->id);
        $user->coin += 100;
        $user->save();
        Alert::success('Topup Successful!', 'Now you have '.$user->coin.' coin(s)');
        return redirect()->back();
    }

    public function switchIncognito(){
        $user = User::find(Auth::user()->id);
        if($user->is_incognito){
            if($user->coin <5){
                Alert::error('Not Enough Coin!', 'You need at least 5 coin to switch to normal mode');
                return redirect()->back();
            }
            $user->coin -= 5;
            $user->incognito_bear = null;
        }
        else{
            if($user->coin <50){
                Alert::error('Not Enough Coin!', 'You need at least 50 coin to switch to normal mode');
                return redirect()->back();
            }
            $user->coin -= 50;
            $user->incognito_bear = "/img/bear/".rand(1,3).".png";
        }

        $user->is_incognito = !$user->is_incognito;
        
        $user->save();
        Alert::success('Incognito Mode Switched!', '');
        return redirect()->back();
    }

    public function payRegist(Request $request){
        // dump($request->all());
        $user = User::find($request->id);
        $user->has_pay = true;
        if($user->regist_price < $request->amount){
            $user->coin += $request->amount - $user->regist_price;
        }
        $user->save();

        Alert::success('Payment Successful!', '');

        if(Auth::check()){
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    }
}
