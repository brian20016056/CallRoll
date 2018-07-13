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
Route::get('{userId?}', ['as' => 'index', 'uses' => 'IndexController@index']);

Route::get('user/login', ['as' => 'userLogin', 'uses' => 'UserController@login']);

Route::post('user/auth', ['as' => 'userAuth', 'uses' => 'UserController@auth']);

Route::get('user/signup', ['as' => 'userSignup', 'uses' => 'UserController@signup']);



Auth::routes();

Route::get('/home', ['as' => 'hame', 'uses' => 'HomeController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
