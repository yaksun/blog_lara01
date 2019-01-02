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

Route::get('/', 'Home\IndexController@index');
Route::get('cate/{cate_id}', 'Home\IndexController@cate');
Route::get('a/{art_id}', 'Home\IndexController@article');
//Route::get('admin/test', 'Admin\LoginController@test');


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

    //后台友情链接路由
    Route::resource('links','LinksController');
    Route::post('links/changeorder','LinksController@changeOrder');

    //后台自定义导航路由
    Route::resource('navs','NavsController');
    Route::post('navs/changeorder','NavsController@changeOrder');

});