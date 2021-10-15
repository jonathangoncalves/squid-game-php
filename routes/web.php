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

Route::get('/', '\App\Http\Controllers\InterfaceController@index');
Route::get('/settings', '\App\Http\Controllers\InterfaceController@getSettings');
Route::post('/settings', '\App\Http\Controllers\InterfaceController@storeSettings');
Route::get('/game/{game_uuid}', '\App\Http\Controllers\InterfaceController@game');


Route::group(['prefix' => '/ws'], function(){
    Route::post('/game', '\App\Http\Controllers\GameApiController@createGame');
    Route::get('/games', '\App\Http\Controllers\GameApiController@getGames');
    Route::get('/game/{game_uuid}', '\App\Http\Controllers\GameApiController@getGame');
    Route::put('/game/{game_uuid}/step/{step}', '\App\Http\Controllers\GameApiController@makeStep');
});
