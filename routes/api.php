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

Route::middleware('auth:api')->get('/profile', 'ProfileController@fetch');
Route::middleware('auth:api')->post('/profile', 'ProfileController@update');

//Route::middleware('auth:api')->get('/project{id?}', 'ProjectController@index');
Route::middleware('auth:api')->get('/project', 'ProjectController@test');

Route::middleware('auth:api')->post('/project', 'ProjectController@create');

//Route::middleware('auth:api')->get('/project/{action}/{value}', 'ProjectController@search');
