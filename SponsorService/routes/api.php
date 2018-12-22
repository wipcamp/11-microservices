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

Route::get('/posts', 'SponsorController@getPosts');
Route::get('/post/{sponsor_id}', 'SponsorController@getPost');
Route::post('/create', 'SponsorController@createSponsor');
Route::put('/updatespon', 'SponsorController@updateSpon');
Route::delete('/delete/{sponsor_id}', 'SponsorController@delete');
