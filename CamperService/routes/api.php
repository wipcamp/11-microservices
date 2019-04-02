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
    Route::post('/', 'CampersController@mangeCampers');
    Route::post('/upload', 'CampersController@uploadFile');
    Route::get('/getfile', 'CampersController@getFile');
    
});

Route::group(['middleware' => ['CheckAuth']], function () {
    Route::prefix('campers')->group(function () {
        Route::post('/upload/{path}', 'DocumentsController@uploadFile');
        Route::get('/', 'CampersController@getCampers');    
        Route::get('/document','DocumentsController@getDocumentByWipId');
        Route::post('/size','DocumentsController@updateSize');
        Route::post('/location','DocumentsController@updateLocation');
        Route::post('/confirm', 'DocumentsController@confirmCamper');
        Route::get('/success', 'DocumentsController@getDocumentAllSuccess');
        Route::post('/image', 'DocumentsController@getPreviewImageByWipId');
    });
});