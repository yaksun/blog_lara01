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


//后台登录路由
Route::any('admin/login','Admin\LoginController@login');
Route::get('admin/code','Admin\LoginController@getCode');

//Route::get('/admin/test','Admin\LoginController@test');


//中间件.前缀.命名空间
Route::group(['middleware'=>'adminlogin','prefix'=>'admin','namespace'=>'Admin'],function(){

    //后台首页路由
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('quit','IndexController@quit');
    Route::any('pass','IndexController@pass');

    //后台分类路由
    Route::resource('category','CategoryController');
    Route::post('category/changeorder','CategoryController@changeOrder');

    //后台文章路由
    Route::resource('article','ArticleController');
    //上传文件路由
    Route::any('upload','CommonController@upload');


    //后台配置项路由
    Route::resource('conf','ConfController');
    Route::post('conf/changeorder','ConfController@changeOrder');
    Route::post('conf/changecontent','ConfController@changeContent');
    Route::get('putfile','ConfController@putFile');




});