<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/game', '\App\Http\Controllers\GameController@createGame');
Route::get('/game/{game_uuid}', '\App\Http\Controllers\GameController@getGame');
Route::put('/game/{game_uuid}/step/{step}', '\App\Http\Controllers\GameController@makeStep');
