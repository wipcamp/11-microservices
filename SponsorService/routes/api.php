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

Route::get('/sponsors', 'SponsorController@getPosts');
Route::get('/sponsor/{sponsor_id}', 'SponsorController@getPost');
Route::post('/sponsor', 'SponsorController@createSponsor');
Route::put('/sponsor/{sponsor_id}', 'SponsorController@updateSponname');
Route::put('/sponsor/{sponsor_id}', 'SponsorController@updateSponorder');
Route::delete('/sponsor/{sponsor_id}', 'SponsorController@delete');
