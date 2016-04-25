<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/api/list', 'DashboardController@results');
Route::post('/api/create', 'DashboardController@store');
Route::patch('/api/check/{id}', 'DashboardController@check');
Route::patch('/api/update/{id}', 'DashboardController@update');
Route::delete('/api/delete/{id}', 'DashboardController@delete');
