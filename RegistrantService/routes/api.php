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

Route::get('jwt', function (Request $request) {
    return response()->json('hello' . $request['wip_id']);
})->middleware('checkAuth');
//API Questions

//API Profiles
Route::prefix('profile')->group(function(){
    // Route::get('/', 'ProfileController@getProfile');
    // Route::post('/', 'ProfileController@createProfile');
    // Route::put('/update', 'ProfileController@updateProfile');
    Route::get('/getAnswers', 'ProfileController@getAnswers');
});

Route::group(['middleware' => ['checkAuth']], function () {
// API User
    Route::prefix('questions')->group(function(){
        Route::get('/', 'QuestionController@getQuestions');
        Route::get('/{question_id}','QuestionController@getQuestionById');
    });

//API Answers
    Route::prefix('answers')->group(function () {
        Route::get('/', 'AnswerController@getAnswersByWipId');
        Route::post('/', 'AnswerController@manageAnswer');
        Route::put('/', 'AnswerController@edit');
        //API wippo
        Route::post('/evaluations', 'AnswerEvaluationController@getAnswerEvaluations');
    });

//API Profile
    Route::get('/profile','ProfileController@getProfile');
    Route::post('/profile', 'ProfileController@createProfile');
    Route::put('/profile','ProfileController@updateProfile');



//API Registrant
    Route::get('/registrant', 'RegistrantController@getRegistrant');
});


//API Schools
Route::prefix('schools')->group(function () {
    Route::get('/', 'SchoolController@getSchool');
    Route::get('/name','SchoolController@getSchoolByName');
   });
