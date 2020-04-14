<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv-shows', 'TvController@index')->name('tvshows.index');
Route::get('/tv-shows/{id}', 'TvController@show')->name('tvshows.show');

Route::get('/peoples', 'PeoplesController@index')->name('peoples.index');
Route::get('/peoples/page/{page?}', 'PeoplesController@index')->name('peoples.pagination');

Route::get('/peoples/{person}', 'PeoplesController@show')->name('peoples.show');
