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

Route::middleware('auth:api')->group(function()
{
    Route::post('/team', 'Api\TeamController@create')->name('create');    
});

Route::post('/token/{id}', 'Api\ApiTokenController@token')->name('token');
Route::post('/register/{player_id}', 'Api\RegisterController@create')->name('create');
Route::post('/update/{id}', 'Api\RegisterController@update')->name('update');
Route::post('/login', 'Api\RegisterController@login')->name('login');
Route::post('/player', 'Api\PlayerController@create')->name('create');
Route::post('/player/{id}', 'Api\PlayerController@update')->name('update');
Route::get('/player/{name}', 'Api\PlayerController@find')->name('find');
Route::get('/teams/{name}', 'Api\TeamController@find')->name('find');
Route::get('/team/{team_id}', 'Api\TeamController@show')->name('show');
