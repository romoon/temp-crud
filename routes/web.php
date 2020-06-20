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

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// User 認証不要
Route::get('/', function () { return redirect('/home'); });
Route::get('/index', function () { return view('index'); });

// User ログイン後
Route::group(['middleware' => 'auth:user'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('user/posts/create', 'User\PostController@add');
    Route::post('user/posts/create', 'User\PostController@create');
    Route::get('user/posts/index', 'User\PostController@index');
    Route::get('user/posts/edit', 'User\PostController@edit');
    Route::post('user/posts/edit', 'User\PostController@update');
    Route::get('user/posts/delete', 'User\PostController@delete');
    Route::get('user/profile/edit', 'User\ProfileController@edit');
    Route::post('user/profile/edit', 'User\ProfileController@update');
});

// Admin 認証不要
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/login'); });
    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\LoginController@login')->name('admin.login');
});

// Admin ログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::get('/', 'Admin\HomeController@index')->name('admin.index');
    Route::get('/home', 'Admin\HomeController@index')->name('admin.index');
    Route::get('/index', 'Admin\HomeController@index');
    Route::get('admin/delete', 'Admin\HomeController@delete');
    Route::get('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
    // Route::post('/home', 'Admin\HomeController@index')->name('admin.home');
});
