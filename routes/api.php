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

Route::post('/token/{id}', 'Api\ApiTokenController@token')->name('token');
Route::post('/register', 'Api\RegisterController@create')->name('create');
Route::post('/update/{id}', 'Api\RegisterController@update')->name('update');
Route::post('/login', 'Api\RegisterController@login')->name('login');
Route::post('/player', 'Api\PlayerController@create')->name('create');
Route::post('/player/{id}', 'Api\PlayerController@update')->name('update');