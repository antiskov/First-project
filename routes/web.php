<?php

use Illuminate\Support\Facades\Route;
use App\Topic;

Route::get('/', 'ContentController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')
->name('home');

Route::get('/admin', 'AdminController@admin')
->middleware('auth', 'is_admin');

Route::get('/topic', 'ContentController@newTopic')
->middleware('auth')->name('topic');

Route::post('/add_topic', 'ContentController@addTopic')
->name('add-topic');

Route::get('/', 'ContentController@allTopics');

Route::get('/{topic}/treds', 'ContentController@tredsAction')
->name('treds');

Route::get('/{topic}/treds/new_tred', 'ContentController@newTred')
->name('new-tred');

/*Route::get('/new_tred', 'ContentController@newTred')
->name('new-tred');*/

Route::post('add_tred', 'ContentController@addTred')
->name('add-tred');

Route::get('/commun', 'ContentController@commun')
->name('commun');

Route::post('/add_commun','ContentController@addCommun')
->name('add-commun');