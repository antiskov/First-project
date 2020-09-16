<?php

use Illuminate\Support\Facades\Route;
use App\Topic;

Auth::routes();

Route::get('/admin', 'AdminController@admin')
->middleware('auth', 'is_admin');

Route::get('/topic', 'TopicController@newTopic')
->middleware('auth')->name('topic');

Route::post('/add_topic', 'TopicController@addTopic')
->name('add-topic');

Route::get('/', 'TopicController@allTopics');

Route::get('topic/{topic}/treds', 'TredController@tredsAction')
->name('treds');

Route::get('topic/{topic}/treds/new_tred', 'TredController@newTred')
->name('new-tred');

Route::post('topic/{topic}/treds/new_tred/add_tred', 'TredController@addTred')
->name('add-tred');

/*Route::get('/{topic}/{tred}/commun', 'ContentController@commun')
->name('commun'); */

Route::get('topic/{topic}/tred/{tred}/commun', 'CommunController@commun')
->name('commun');

Route::post('/add_commun','CommunController@addCommun')
->name('add-commun');