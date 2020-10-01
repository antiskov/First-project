<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('profile', 'ProfileController@index');

Route::get('home', 'ProfileController@index');

Route::post('profile_image', 'ProfileController@profileImage')
    ->name('profile-image');

Route::get('set', 'TopicController@setNew')
    ->middleware('auth')
    ->name('topic');

Route::post('set', 'TopicController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('set-topic');

Route::get('/', 'TopicController@getAll')
    ->name('topics');

Route::get('{topic}/delete', "TopicController@delete")
    ->name('delete-topic');

Route::get('{topic}/threads', 'ThreadController@getAll')
    ->name('threads');

Route::get('{topic}/set-thread', 'ThreadController@setNew')
    ->middleware('auth')
    ->name('new-thread');

Route::post('{topic}/set-thread', 'ThreadController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('set-thread');

Route::get('{topic}/t/{thread}/delete', 'ThreadController@delete')
    ->name('delete-thread');

Route::get('{thread}/board', 'BoardController@getAll')
    ->name('board');

Route::post('{thread}/set-board','BoardController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('set-board');

Route::get('{thread}/b/{board}/delete', 'BoardController@delete')
    ->name('delete-board');

Route::get(
    '{thread}/{board}/set-answer', 'AnswerController@get')
    ->name('new-answer');

Route::post(
    '{thread}/{board}/set-answer', 'AnswerController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('set-answer');

Route::get(
    '{thread}/{board}/{answer}/answer-on-answer',
    'AnswerController@getOnAnswer')
    ->name('answer-on');

Route::post(
    '{thread}/{board}/{answer}/answer-on-answer', 'AnswerController@setOnAnswer')
    ->middleware('auth', 'throttle:7,1')
    ->name('answer-on-answer');

Route::get('user_profile/{user}', 'UserController@userPage')
    ->name('user-page');

Route::prefix('admin')->middleware(['auth', 'is_admin', 'throttle:50,1'])->group(function () {
    Route::get('soft-deleted', 'AdminController@softDeleted')
        ->name('soft-deleted');
    Route::get('topic/{topic}/restore', 'TopicController@restore')
        ->name('restore-topic');
    Route::get('thread/{thread}/restore', 'ThreadController@restore')
        ->name('restore-thread');
    Route::get('board/{board}/restore', 'BoardController@restore')
        ->name('restore-board');
    Route::get('/', 'AdminController@getAll')
        ->name('admin-panel');
    Route::get('topic/{topic}/', 'ThreadController@getAllForAdmin')
        ->name('admin-treds');
    Route::get('{thread}/b', 'BoardController@getAllForAdmin')
        ->name('admin-board');
    Route::get('{topic}/delete/s', 'TopicController@deleteForAdmin')
        ->name('delete-topic-admin');
    Route::get('{topic}/thread/{thread}/delete', 'ThreadController@deleteForAdmin')
        ->name('delete-thread-admin');
    Route::get('{thread}/board/{board}/delete', 'BoardController@deleteForAdmin')
        ->name('delete-board-admin');
    Route::get('t/{topic}/force-delete', 'TopicController@forceDelete')
        ->name('force-delete-topic');
    Route::get('{topic}/{thread}/force-delete', 'ThreadController@forceDelete')
        ->name('force-delete-thread');
    Route::get('{thread}/b/{board}/force-delete', 'BoardController@forceDelete')
        ->name('force-delete-board');
});
