<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台主页

Route::get('admin/index', 'Admin\IndexController@index');        
Route::get('admin/welcome', 'Admin\IndexController@welcome');        

//后台用户
Route::get('admin/user/index', 'Admin\UserController@index');        
Route::get('admin/user/add', 'Admin\UserController@add');        
Route::post('admin/user/doadd', 'Admin\UserController@doadd');        
Route::get('admin/user/edit/{id}', 'Admin\UserController@edit');
Route::post('admin/user/doedit', 'Admin\UserController@doedit');
Route::post('admin/user/destroy/{id}', 'Admin\UserController@destroy');
//轮播图管理
Route::get('admin/picture/index','Admin\Rotation_chartController@index');
Route::get('admin/picture/add','Admin\Rotation_chartController@add');
Route::post('admin/picture/doadd','Admin\Rotation_chartController@doadd');
Route::get('admin/picture/edit/{id}','Admin\Rotation_chartController@edit');
Route::post('admin/picture/doedit','Admin\Rotation_chartController@doedit');
Route::get('admin/picture/display/{id}','Admin\Rotation_chartController@display');

