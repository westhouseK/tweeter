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

Route::get('/', 'AuthController@login');
Route::get('callback', 'AuthController@callback');
Route::get('showform', 'TwitterFormController@showForm');

Route::get('timeout', 'TwitterFormController@showTimeout');
Route::get('about', 'TwitterFormController@showAbout');

// ajax
Route::post('post', 'TwitterFormController@postTweet');