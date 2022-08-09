<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return back();
});
 
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home/{gender?}', [Controller::class, 'dashboard']);
Route::get('/search', [Controller::class, 'search']);
Route::get('/login', [Controller::class, 'login'])->name('login');


Route::get('/register', [Controller::class, 'register']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/payRegist/{id}', [Controller::class, 'payRegist']);
Route::post('/payRegist/{id}', [UserController::class, 'payRegist']);

//login
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['user'])->group(function () {
    Route::get('/message', [Controller::class, 'message']);
    Route::get('/avatar', [Controller::class, 'avatar']);
    Route::get('/topup', [Controller::class, 'topup']);
    Route::get('/giveAvatar/{id}', [Controller::class, 'giveAvatar']);
    Route::get('/chat/{id}', [Controller::class, 'chatroom']);
    Route::get('/user/{id}', [Controller::class, 'userDetail']);
    Route::get('/profile', [Controller::class, 'profile']);
    Route::get('/incognito', [Controller::class, 'incognito']);

    //friend req
    Route::post('/sendFriendReq', [FriendController::class, 'sendFriendReq']);
    Route::post('/cancelFriendReq', [FriendController::class, 'cancelFriendReq']);
    Route::post('/acceptFriendReq', [FriendController::class, 'acceptFriendReq']);

    //avatar
    Route::post('/useAvatar', [AvatarController::class, 'useAvatar']);
    Route::post('/buyAvatar', [AvatarController::class, 'buyAvatar']);
    Route::post('/giveAvatar', [AvatarController::class, 'giveAvatar']);

    //topup
    Route::post('/topup', [UserController::class, 'topup']);

    //incognito
    Route::post('switchIncognito', [UserController::class, 'switchIncognito']);


    //ajax
    Route::post('/sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/loadMessage', [ChatController::class, 'loadMessage'])->name('loadMessage');
});

