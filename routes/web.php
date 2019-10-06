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

Route::get('login', 'Auth\LoginController@showLogin');

Route::get('logout', 'Auth\LoginController@logout');

Route::post('login', 'Auth\LoginController@processLogin');

Route::group(['middleware' => ['auth']], function() {
    Route::get('admin', 'AdminController@showAdmin');
    Route::post('draw', 'LuckyDrawController@drawWinner');
});

Route::get('result', 'LuckyDrawController@showResult');

Route::get('/', function () {
    return view('welcome');
});
