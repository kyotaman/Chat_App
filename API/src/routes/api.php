<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// メッセージ関連
Route::get('/messages', 'MessageController@index');
Route::post('/messages', 'MessageController@store');
Route::delete('/messages/{message}', 'MessageController@destroy');

// ユーザー認証関連
Route::post('/login', 'AccountController@login');
Route::post('/register', 'AccountController@register');
