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
 
Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home/{gender?}', [Controller::class, 'dashboard']);
Route::get('/search', [Controller::class, 'search']);
Route::get('/login', [Controller::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['user'])->group(function () {
    Route::get('/message', [Controller::class, 'message']);
    Route::get('/chat/{id}', [Controller::class, 'chatroom']);
    Route::get('/user/{id}', [Controller::class, 'userDetail']);


    //ajax
    Route::post('/sendMessage', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/loadMessage', [ChatController::class, 'loadMessage'])->name('loadMessage');
});

