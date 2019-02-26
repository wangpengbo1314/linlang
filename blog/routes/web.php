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

// 首页
Route::get('admin/index/index','Admin\IndexController@index');
// 我的桌面
Route::get('admin/index/welcome','Admin\IndexController@welcome');



// 后台管理员


//添加管理员
Route::get('admin/user/index','Admin\UserController@index');
// 获取数据，发送到数据库
Route::post('admin/user/show','Admin\UserController@show');
// 遍历数据到页面
Route::get('admin/user/list','Admin\UserController@list');
// 修改管理员数据
Route::get('admin/user/update/{id}','Admin\UserController@update');
// 删除数据
Route::get('admin/user/delete/{id}','Admin\UserController@delete');
// 删除成功页面
Route::post('admin/user/edit/{id}','Admin\UserController@edit');
// 权限管理
Route::get('admin/user/permission','Admin\UserController@permission');
// 用户管理
Route::get('admin/user/role','Admin\UserController@role');

// 友情链接
Route::resource('admin/link','Admin\LinkController');




// 前台管理

// 用户注册
Route::resource('home/register','Home\RegisterController');
// 用户信息
Route::resource('home/user','Home\UserController');
// 轮播图
Route::resource('home/banner','Home\BannerController');