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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::middleware('jwt.auth')->resource('/ip', 'IpController', ['except' => ['edit', 'create']]);
    Route::middleware('jwt.auth')->resource('/jail', 'JailController', ['except' => ['edit', 'create']]);

    Route::middleware('jwt.auth')->post('/control/jail/{id}', 'JailController@toggleJail');
    Route::middleware('jwt.auth')->get('/host/status', 'JailController@getHostStatus');

    Route::middleware('jwt.auth')->get('/snapshot', 'JailController@getSnapshots');
    Route::middleware('jwt.auth')->post('/snapshot', 'JailController@takeSnapshot');
});
