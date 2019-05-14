<?php


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/posts', 'HomeController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', function() {
	return view('test');
});