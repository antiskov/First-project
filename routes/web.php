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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
    return view('admin');
})->middleware('auth', 'is_admin');

Route::get('/topic', function() {
	dd(Topic::with('user')->first()->user->email);
	return view('content.topic');
})->middleware('auth')->name('topic');

Route::post('/add_topic', 'ContentController@addTopic')->name('add-topic');