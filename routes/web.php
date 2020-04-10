<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/peoples', 'PeoplesController@index')->name('peoples.index');
Route::get('/peoples/{people}', 'PeoplesController@show')->name('peoples.show');
