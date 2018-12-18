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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//API Questions
Route::get('/questions','QuestionController@getQuestions');

//API Answers
Route::get('/answers','AnswerController@getAnswers');
Route::post('/','AnswerController@createAnswers');

//API Profiles
Route::get('/profile','ProfileController@getProfile');
Route::post('/profile','ProfileController@createProfile');
Route::group(['middleware' => 'jwt.auth'], function () {
    // API User
    Route::group(['middleware' => ['checkUserByUserId']], function () {
        // API User with user_id
        Route::prefix('/users/{token}')->group(function () {
            Route::get('/', 'UserController@getByUserId');
        });
    });
});

//API Schools
Route::get('/schools','SchoolController@getSchool');