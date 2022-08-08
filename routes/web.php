<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
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
 
Route::get('/', [Controller::class, 'dashboard']);
Route::get('/login', [Controller::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['user'])->group(function () {
    Route::get('/friends', [Controller::class, 'friend']);
    Route::get('/message', [Controller::class, 'message']);
    Route::get('/chat/{id}', [Controller::class, 'chatroom']);


    //ajax
    Route::post('/sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/loadMessage', [ChatController::class, 'loadMessage'])->name('loadMessage');
});

