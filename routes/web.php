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

Route::get('{topic}/{tred}/force-delete', 'ThreadController@forceDelete')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-tred');

Route::get('{thread}/board', 'BoardController@getAll')
    ->name('board');

Route::post('{thread}/set-board','BoardController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('set-board');

Route::get('{thread}/b/{board}/delete', 'BoardController@delete')
    ->name('delete-board');

Route::get('{thread}/{board}/force-delete', 'BoardController@forceDelete')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-board');

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
    '{thread}/{board}/{answer}/answer-on-answer',
    'AnswerController@setOnAnswer')
    ->middleware('auth', 'throttle:7,1')
    ->name('answer-on-answer');

Route::get('user_profile/{user}', 'UserController@userPage')
    ->name('user-page');

Route::prefix('admin')->middleware(['auth', 'is_admin', 'throttle:20,1'])->group(function () {
    Route::get('topic/{topic}/restore', 'TopicController@restoreTopic')
        ->name('restore-topic');
    Route::get('soft-deleted', 'AdminController@softDeleted')
        ->name('soft-deleted');
    Route::get('board/{board}/restore', 'BoardController@restoreBoard')
        ->name('restore-board');
    Route::get('tred/{tred}/restore', 'ThreadController@restoreTred')
        ->name('restore-tred');
    Route::get('t/{tred}/b', 'BoardController@boardForAdmin')
        ->name('admin-board');
    Route::get('{topic}/tred/{tred}/delete', 'ThreadController@deleteTredForAdmin')
        ->name('delete-tred-admin');
    Route::get('{topic}/delete/s', 'TopicController@deleteForAdmin')
        ->name('delete-topic-admin');
    Route::get('/', 'AdminController@admin')
        ->name('admin-panel');
    Route::get('topic/{topic}/', 'ThreadController@tredsActionForAdmin')
        ->name('admin-treds');
    Route::get('{topic}/force-delete', 'TopicController@forceDelete')
        ->name('forcedelete-topic');
});
