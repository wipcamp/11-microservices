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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//API Questions
Route::prefix('questions')->group(function(){
    Route::get('/', 'QuestionController@getQuestions');
    Route::get('/listAll', 'QuestionControllrt@getQuesAndAns');
    Route::get('/{question_id}','QuestionController@getQuestionById');
});

//API Answers
Route::prefix('answers')->group(function () {
    Route::get('/wip_id', 'AnswerController@getAnswersByWipId');
    Route::post('/', 'AnswerController@create');
    Route::put('/', 'AnswerController@edit');
});

//API Profiles
Route::get('/profile', 'ProfileController@getProfile');
Route::post('/profile', 'ProfileController@createProfile');
Route::put('/profile/update', 'ProfileController@updateProfile');
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
Route::get('/schools', 'SchoolController@getSchool');
