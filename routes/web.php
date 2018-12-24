<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/admin/login','Admin\LoginController@login');
Route::get('/admin/code','Admin\LoginController@getCode');

//Route::get('/admin/test','Admin\LoginController@test');

Route::get('/admin/index','Admin\IndexController@index');