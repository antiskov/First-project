<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/admin', 'AdminController@admin')
    ->middleware('auth', 'is_admin')
    ->name('admin-panel');

Route::get('admin/topic/{topic}', 'TredController@tredsActionForAdmin')
    ->middleware('auth', 'is_admin')
    ->name('admin-treds');

Route::get('/profile', 'ProfileController@index');

Route::get('/home', 'ProfileController@index');

Route::post('profile_image', 'ProfileController@profileImage')
    ->name('profile-image');

Route::get('/topic', 'TopicController@newTopic')
    ->middleware('auth')
    ->name('topic');

Route::post('/add_topic', 'TopicController@addTopic')
    ->middleware('auth', 'throttle:2,1')
    ->name('add-topic');

Route::get('/', 'TopicController@allTopics')
    ->name('topics');

Route::get('{topic}/delete', 'TopicController@deleteTopic')
    ->name('delete-topic');

Route::get('admin/{topic}/delete', 'TopicController@deleteTopicForAdmin')
    ->middleware('auth', 'is_admin')
    ->name('delete-topic-admin');

Route::get('{topic}/forcedelete', 'TopicController@forceDeleteTopic')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-topic');

Route::get('topic/{topic}', 'TredController@tredsAction')
    ->name('treds');

Route::get('topic/{topic}/treds/new_tred', 'TredController@newTred')
    ->middleware('auth')
    ->name('new-tred');

Route::post('topic/{topic}/treds/new_tred/add_tred', 'TredController@addTred')
    ->middleware('auth', 'throttle:2,1')
    ->name('add-tred');

Route::get('{topic}/tred/{tred}/delete', 'TredController@deleteTred')
    ->name('delete-tred');

Route::get('admin/{topic}/tred/{tred}/delete', 'TredController@deleteTredForAdmin')
    ->middleware('auth', 'is_admin')
    ->name('delete-tred-admin');

Route::get('{topic}/tred/{tred}/forcedelete', 'TredController@forceDeleteTred')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-tred');

Route::get('/tred/{tred}/', 'BoardController@board')
    ->name('board');

Route::get('admin/tred/{tred}/', 'BoardController@boardForAdmin')
    ->middleware('auth', 'is_admin')
    ->name('admin-board');

Route::post('tred/{tred}/board/add_board','BoardController@addBoard')
    ->middleware('auth', 'throttle:3,1')
    ->name('add-board');

Route::get('{tred}/{board}/delete', 'BoardController@deleteBoard')
    ->name('delete-board');

Route::get('{tred}/{board}/forcedelete', 'BoardController@forceDeleteBoard')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-board');

Route::get(
    'tred/{tred}/board/{board}/answer',
    'AnswerController@answer'
)->name('answer');

Route::post(
	'tred/{tred}/board/{board}/add_board',
	'AnswerController@addAnswer'
    )->name('add-answer');

Route::get('/user_profile/{user}', 'UserController@userPage')
    ->name('user-page');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/topic/{topic}/restore', 'TopicController@restoreTopic')
        ->name('restore-topic');
    Route::get('/soft-deleted', 'AdminController@softDeleted')
        ->name('soft-deleted');
    Route::get('/board/{board}/restore', 'BoardController@restoreBoard')
        ->name('restore-board');
    Route::get('/tred/{tred}/restore', 'TredController@restoreTred')
        ->name('restore-tred');

});
