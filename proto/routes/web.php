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
Route::resource('open_inbox','OpenInboxController');
Route::resource('friends', 'ShowFriendsController');
Route::resource('admin','AdminController');
Route::resource('send_message', 'SendMessageController');
Route::resource('admin_mod', 'AdminModController');
Route::resource('admin_report', 'AdminReportController');

Route::post('/reportPost','PostsController@reportPost');
Route::post('/reportComment','PostsController@reportComment');
Route::post('/increment','PostsController@incrementPostLikes');
Route::post('/decrement','PostsController@decrementPostLikes');
Route::post('/addComment','PostsController@addComment');
Route::post('/new_friend', 'PublicProfileController@friend_request');
Route::post('/accept_friend', 'ProfileController@new_friendship');
Route::post('/ban','AdminController@ban_user');
Route::post('/send_new_message', 'SendMessageController@send_new_message');

Route::get('/getbalancepost','PostsController@getBalancePost');
Route::get('/getAllPosts','PostsController@getAllPosts');

