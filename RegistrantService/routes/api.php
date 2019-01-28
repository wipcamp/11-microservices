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

Route::group(['middleware' => ['checkAuth']], function () {
// API User
    Route::prefix('questions')->group(function () {
        Route::get('/', 'QuestionController@getQuestions');
        Route::get('/{question_id}', 'QuestionController@getQuestionById');
    });

//API Answers
    Route::prefix('answers')->group(function () {
        Route::get('/', 'AnswerController@getAnswersByWipId');
        Route::post('/', 'AnswerController@manageAnswer');
        Route::put('/', 'AnswerController@manageAnswer');
        Route::get('/{question_id}', 'AnswerController@getAnswersByQuestionsId');
        //ของ line
        Route::get('/line/{question_id}', 'AnswerController@getAnswersByQuestionbywipId');
        //API wippo
        Route::post('/evaluations', 'AnswerEvaluationController@AnswerEvaluations');
    });

//API Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@getProfile');
        Route::post('/', 'ProfileController@createProfile');
        Route::put('/', 'ProfileController@updateProfile');
    });

//API Registrant
    Route::get('/registrants', 'RegistrantController@getRegistrants');
});

//API Schools
Route::prefix('schools')->group(function () {
    Route::get('/', 'SchoolController@getSchool');
    Route::get('/name', 'SchoolController@getSchoolByName');
});

//API Dashboard
Route::prefix('stats')->group(function () {
    Route::prefix('/registrants')->group(function () {
        Route::get('/', 'DashboardController@getRegistrantStats');
        Route::get('/date', 'DashboardController@getRegistrantStatsByDate');
        Route::get('/time', 'DashboardController@getRegistrantStatsByTime');
    });
});
