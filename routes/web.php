<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MovieController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MovieController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{tv}', 'TvController@show')->name('tv.show');

Route::get('/actors', 'ActorController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorController@index');
Route::get('/actors/{actor}', 'ActorController@show')->name('actors.show');



