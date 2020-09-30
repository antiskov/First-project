<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/profile', 'ProfileController@index');

Route::get('/home', 'ProfileController@index');

Route::post('profile_image', 'ProfileController@profileImage')
    ->name('profile-image');

Route::get('/set-new', 'TopicController@setNew')
    ->middleware('auth')
    ->name('topic');

Route::post('/set', 'TopicController@set')
    ->middleware('auth', 'throttle:4,1')
    ->name('add-topic');

Route::get('/', 'TopicController@getAll')
    ->name('topics');

Route::get('{topic}/delete', "TopicController@delete")
    ->name('delete-topic');

Route::get('topic/{topic}', 'ThreadController@tredsAction')
    ->name('treds');

Route::get('topic/{topic}/treds/new-thread', 'ThreadController@newTred')
    ->middleware('auth')
    ->name('new-tred');

Route::post('/{topic}/add-thread', 'ThreadController@addTred')
    ->middleware('auth', 'throttle:4,1')
    ->name('add-tred');

Route::get('{topic}/tred/{tred}/', 'ThreadController@deleteTred')
    ->name('delete-tred');

Route::get('{topic}/tred/{tred}/forcedelete', 'ThreadController@forceDeleteTred')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-tred');

Route::get('/tred/{tred}/', 'BoardController@board')
    ->name('board');

Route::post('tred/{tred}/board/add-board','BoardController@addBoard')
    ->middleware('auth', 'throttle:4,1')
    ->name('add-board');

Route::get('{tred}/{board}/delete', 'BoardController@deleteBoard')
    ->name('delete-board');

Route::get('{tred}/{board}/forcedelete', 'BoardController@forceDeleteBoard')
    ->middleware('auth', 'is_admin')
    ->name('forcedelete-board');

Route::get(
    'tred/{tred}/board/{board}/answer',
    'AnswerController@answer')
    ->name('answer');

Route::post(
    'tred/{tred}/board/{board}/add-answer',
    'AnswerController@addAnswer')
    ->middleware('auth', 'throttle:4,1')
    ->name('add-answer');

Route::get(
    '/{tred}//{board}/{answer}',
    'AnswerController@answerOn')
    ->name('answer-on');

Route::post(
    '{tred}/{board}/{answer}',
    'AnswerController@answerOnAnswer')
    ->middleware('auth', 'throttle:7,1')
    ->name('answer-on-answer');

Route::get('/user_profile/{user}', 'UserController@userPage')
    ->name('user-page');

Route::prefix('admin')->middleware(['auth', 'is_admin', 'throttle:20,1'])->group(function () {
    Route::get('/topic/{topic}/restore', 'TopicController@restoreTopic')
        ->name('restore-topic');
    Route::get('/soft-deleted', 'AdminController@softDeleted')
        ->name('soft-deleted');
    Route::get('/board/{board}/restore', 'BoardController@restoreBoard')
        ->name('restore-board');
    Route::get('/tred/{tred}/restore', 'ThreadController@restoreTred')
        ->name('restore-tred');
    Route::get('/t/{tred}/b', 'BoardController@boardForAdmin')
        ->name('admin-board');
    Route::get('/{topic}/tred/{tred}/delete', 'ThreadController@deleteTredForAdmin')
        ->name('delete-tred-admin');
    Route::get('/{topic}/delete/s', 'TopicController@deleteForAdmin')
        ->name('delete-topic-admin');
    Route::get('/', 'AdminController@admin')
        ->name('admin-panel');
    Route::get('/topic/{topic}/', 'ThreadController@tredsActionForAdmin')
        ->name('admin-treds');
    Route::get('/{topic}/force-delete', 'TopicController@forceDelete')
        ->name('forcedelete-topic');
});
