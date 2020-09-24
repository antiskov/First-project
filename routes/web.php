<?php

use Illuminate\Support\Facades\Route;
use App\Topic;

Auth::routes();

Route::get('/admin', 'AdminController@admin')
    ->middleware('auth', 'is_admin');

Route::get('/profile', 'ProfileController@index');

Route::get('/home', 'ProfileController@index');

Route::post('profile_image', 'ProfileController@profileImage')
    ->name('profile-image');

Route::get('/topic', 'TopicController@newTopic')
    ->middleware('auth')
    ->name('topic');

Route::post('/add_topic', 'TopicController@addTopic')
    ->name('add-topic');

Route::get('/', 'TopicController@allTopics')
    ->name('topics');

Route::get('{topic}/delete', 'TopicController@deleteTopic')
    ->name('delete-topic');

Route::get('topic/{topic}', 'TredController@tredsAction')
    ->name('treds');

Route::get('topic/{topic}/treds/new_tred', 'TredController@newTred')
    ->name('new-tred');

Route::post('topic/{topic}/treds/new_tred/add_tred', 'TredController@addTred')
    ->name('add-tred');

Route::get('{topic}/tred/{tred}/delete', 'TredController@deleteTred')
    ->name('delete-tred');

Route::get('/tred/{tred}/', 'BoardController@board')
    ->name('board');

Route::post('tred/{tred}/board/add_board','BoardController@addBoard')
    ->name('add-board');

Route::get(
	'tred/{tred}/board/{board}/new_quote',
	'BoardController@boardQuote'
    )->name('new-quote');

Route::get('{tred}/{board}/delete', 'BoardController@deleteBoard')
    ->name('delete-board');

Route::post(
	'tred/{tred}/board/{board}/add_board/',
	'BoardController@addBoardQuote'
    )->name('add-quote');

Route::get('/user_profile/{user}', 'UserController@userPage')
    ->name('user-page');
