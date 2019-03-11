<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your appli

cation. These++
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台主页
 Route::get('admin/index','Admin\IndexController@index');

//商品管理
Route::get('admin/info/{id}','Admin\InfoController@index');
Route::resource('admin/goods','Admin\GoodsController');

//商品评论
Route::get('admin/comment/create1/{id}','Admin\CommentController@create1');
Route::get('admin/comment/index/{id}','Admin\InfoController@index');
Route::resource('admin/comment','Admin\CommentController');

// 商品详情
Route::get('admin/info/create1/{id}','Admin\InfoController@create1');


Route::resource('admin/info','Admin\InfoController');

//分类管理
Route::get('admin/cates/create/{id}','Admin\CatesController@create');
Route::resource('admin/cates','Admin\CatesController');

//订单管理
Route::resource('admin/order','Admin\OrderController');

//收藏管理
Route::resource('admin/collection','Admin\CollectionController');


//前台商品详情
Route::get('home/info/{id}','Home\IndexController@info');
Route::get('home/show/{id}','Home\IndexController@show');
Route::get('home/shopcart/{id}','Home\IndexController@shopcart');
//前台主页
Route::resource('home/index','Home\IndexController');





