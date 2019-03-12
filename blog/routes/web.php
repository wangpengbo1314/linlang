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









































































































































































































// 用户登录
Route::get('/','Home\RegisterController@index');
Route::post('home/login','Home\RegisterController@login')->middleware('Register');
Route::get('home/logout','Home\RegisterController@logout');
// 首页
// Route::get('admin/index','Admin\IndexController@index');
// 我的桌面
Route::get('admin/index/welcome','Admin\IndexController@welcome');

// 后台登录
Route::get('admin/index','Admin\LoginController@index');
Route::post('admin/login','Admin\LoginController@login')->middleware('login');
Route::get('admin/logout','Admin\LoginController@logout');


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



Route::get('/home/register/pass','Home\RegisterController@pass');
Route::post('/home/register/dataword','Home\RegisterController@dataword');

// 修改密码
Route::get('home/register/list','Home\RegisterController@list');
// 用户注册
Route::resource('home/register','Home\RegisterController');

// 收货地址
Route::post('/home/address/list','Home\AddressController@list');
Route::resource('/home/address','Home\AddressController');

// 用户信息
Route::get('/home/user/personal','Home\UserController@personal');
Route::get('/home/user/update2/{id}','Home\UserController@update2');
Route::post('/home/user/update1','Home\UserController@update1');
Route::post('/home/user/role','Home\UserController@role');
Route::post('/home/user/search','Home\UserController@search');
Route::resource('home/user','Home\UserController');
// 轮播图
Route::resource('home/banner','Home\BannerController');


// 用户安全设置
Route::get('/home/safety/index','Home\SafetyController@index');

// 邮箱验证
Route::get('/home/safety/email','Home\SafetyController@email');
Route::post('/home/safety/show','Home\SafetyController@show');
Route::post('/home/safety/list','Home\SafetyController@list');

// 购物车
Route::get('/home/shop/index','Home\ShopController@index');
Route::post('/home/shop/show','Home\ShopController@show');
Route::get('/home/shop/jia/{id}','Home\ShopController@jia');
Route::get('/home/shop/jian/{id}','Home\ShopController@jian');
Route::get('/home/shop/delete/{id}','Home\ShopController@delete');
Route::get('/home/shop/cart','Home\ShopController@cart');
Route::post('/home/shop/revise','Home\ShopController@revise');
Route::post('/home/shop/check','Home\ShopController@check');
Route::get('/home/shop/update','Home\ShopController@update');

// 收藏夹
Route::get('/home/collection/index','Home\CollectionController@index');
Route::get('/home/collection/list','Home\CollectionController@list');
Route::post('/home/collection/show','Home\CollectionController@show');
Route::get('/home/collection/delete/{id}','Home\CollectionController@delete');

// 订单
Route::get('/home/pay/index','Home\PayController@index');
Route::get('/home/pay/list/{table}','Home\PayController@list');
Route::get('/home/pay/orders','Home\PayController@orders');
Route::get('/home/pay/ordersinfo','Home\PayController@ordersinfo');
Route::get('/home/pay/show/{id}','Home\PayController@show');
Route::get('/home/pay/comment/{id}','Home\PayController@comment');
Route::post('/home/pay/assess/{id}','Home\PayController@assess');
Route::get('/home/pay/comments','Home\PayController@comments');

// 后台订单
Route::get('/admin/order/index','Admin\OrderController@index');
Route::post('/admin/order/show','Admin\OrderController@show');