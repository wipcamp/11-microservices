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

Route::group([
  'middleware' => ['api'],
  'prefix' => 'auth'
], function ($router) {
  Route::get('', function ($request, $response) {
    return 'hello';
  });
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
  Route::post('connect', 'AuthController@connect');
});

Route::group(['middleware' => ['checkAuth']], function () {
    Route::get('permissions', 'RolePermissionController@getPermissionByWipId');
    Route::get('role', 'RolePermissionController@getRoleForRegistrants');
     Route::get('rolepending', 'RolePermissionController@getAllrolependings');
     Route::get('allroles', 'RolePermissionController@getallRoles');
    Route::put('changstatus', 'RolePermissionController@UpdateRoles');
    Route::put('changerole','RolePermissionController@changeRoleByWipId');     
});
