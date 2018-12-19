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
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS');

Route::get('jwt', function (Request $request) {
    return response()->json('hello' . $request['wip_id']);
})->middleware('checkAuth');
//API Questions
Route::get('/questions','QuestionController@getQuestions');
Route::get('/questions/show','QuestionControllrt@getQuesAndAns');
//API Answers
Route::get('/answers','AnswerController@getAnswersByWipID');
Route::post('/answer','AnswerController@create');
Route::put('/answer/edit','AnswerController@edit');

//API Profiles
Route::post('/profile','ProfileController@createProfile');

Route::group(['middleware' => ['checkAuth']], function () {
    // API User
    Route::put('/profile','ProfileController@updateProfile');
    Route::get('/profile','ProfileController@getProfile');
});

//API Schools
Route::get('/schools','SchoolController@getSchool');
