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

Route::resource('/', 'PostsController');
Route::get('/about', 'PagesController@about');
Route::get('/error', 'PagesController@error');

Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profile','ProfileController');
Route::resource('publicprofile','PublicProfileController');
Route::resource('inbox','InboxController');

Route::post('/increment','PostsController@incrementPostLikes');
Route::post('/decrement','PostsController@decrementPostLikes');
Route::post('/addComment','PostsController@addComment');

Route::get('/getbalancepost','PostsController@getBalancePost');

