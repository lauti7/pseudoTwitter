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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::post('/{username}/dm', 'UserController@sendPrivateMessage')->middleware('auth');
Route::get('/conversations/{conversation}', 'UserController@showConversation');

Route::get('/messages', 'MessagesController@search');

Route::get('/', 'PagesController@home');
Route::get('/messages/{message}', 'MessagesController@show');
Route::post('/message/create', 'MessagesController@create')->middleware('auth');
Route::get('/{username}/following', 'UserController@follows');
Route::get('/{username}/followers', 'UserController@followers');
Route::post('/{username}/follow', 'UserController@follow')->middleware('auth');
Route::post('/{username}/unfollow', 'UserController@unfollow')->middleware('auth');
Route::get('/{username}', 'UserController@show')->name('userProfile');

Route::get('/api/messages/{message}/responses', 'MessagesController@responses');

Route::get('/api/notifications', 'UserController@notifications');
