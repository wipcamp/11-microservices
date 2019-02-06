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

Route::get('/sponsors', 'SponsorController@getSponsors');
Route::get('/sponsor/{sponsor_id}', 'SponsorController@getSponsor');

Route::group(['middleware' => ['checkAuth']], function () {
  Route::post('/sponsor', 'SponsorController@createSponsor');
  Route::put('/sponsor/{sponsor_id}', 'SponsorController@updateSponname');
  Route::delete('/sponsor/{sponsor_id}', 'SponsorController@delete');
});