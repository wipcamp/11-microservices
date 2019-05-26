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

Route::prefix('test')->group(function () {
    Route::get('/', 'CampersController@getCampers');
    Route::get('/score', 'FlavorsScoreController@viewScores');
});
Route::group(['middleware' => ['CheckAuth']], function () {
    Route::prefix('campers')->group(function () {
        Route::post('/score', 'FlavorsScoreController@insertScore');
        Route::post('/upload/{path}', 'DocumentsController@uploadFile');
        Route::get('/', 'CampersController@getCampers');    
        Route::get('/document','DocumentsController@getDocumentByWipId');
        Route::post('/size','DocumentsController@updateSize');
        Route::post('/camper','CampersController@getCamperByWipId');
        Route::post('/location','DocumentsController@updateLocation');
        Route::post('/confirm', 'DocumentsController@confirmCamper');
        Route::get('/documents', 'DocumentsController@getAllDocument');
        Route::put('/image', 'DocumentsController@getPreviewImageByWipId');
        Route::put('/resons', 'DocumentsController@updateReson');
        Route::put('/updatecamper', 'DocumentsController@updateCamper');
        Route::post('/createcampers', 'DocumentsController@createCampers');
        Route::get('/flavors','FlavorsController@getFlavors');
        Route::get('/getdocconfirm','DocumentsController@getDocumentConfirmByWipId');
        Route::put('/checkin','CampersController@checkInCamper');
    });
});