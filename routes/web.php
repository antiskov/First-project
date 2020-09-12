<?php

use Illuminate\Support\Facades\Route;
use App\Topic;

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

Route::get('/', 'WelcomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
    return view('admin');
})->middleware('auth', 'is_admin');

Route::get('/topic', function() {
	return view('content.topic');
})->middleware('auth')->name('topic');

Route::post('/add_topic', 'ContentController@addTopic')->name('add-topic');

Route::get('/', 'ContentController@allTopics');

Route::get('/treds/{topic}', 'WelcomeController@tredsAction')->name('treds');

Route::get('/new_tred', 'WelcomeController@newTred')->name('tred.create');

Route::post('/add_tred', 'ContentController@addTred')->name('add-tred');

Route::get('/commun', 'ContentController@commun')->name('commun');