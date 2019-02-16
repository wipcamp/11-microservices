<?php

use Illuminate\Http\Request;

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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token,Authorization');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('players', 'PlayersController@getPlayers');
Route::get('janpu', 'JanpuController@getScore');
Route::get('janpu3score', 'JanpuController@getScores');
Route::post('janpu', 'JanpuController@setScore');
