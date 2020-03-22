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
Route::group(['prefix' => 'v2', 'namespace' => 'Api'], function () {
    Route::resource('post', 'PostController')->only(['index']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'data'], function(){
    Route::get('/halo', function(){
        return \App\User::all();
    });
});
