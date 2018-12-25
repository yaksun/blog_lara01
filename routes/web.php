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


//中间件.前缀.命名空间
Route::group(['middleware'=>'adminlogin','prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('/index','IndexController@index');
    Route::get('/info','IndexController@info');
    Route::get('/quit','IndexController@quit');
    Route::any('/pass','IndexController@pass');

});