<?php

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

Route::get('/', ['as' => 'welcome', 'uses' => 'StudioController@index']);
Route::get('/studio/search', ['as' => 'studio.search', 'uses' => 'StudioController@search']);
Route::get('studio/{studio_url}', ['as' => 'studio.details', 'uses' => 'StudioController@show']);
Route::post('studio/booking/store', ['as' => 'studio.booking.store', 'uses' => 'StudioController@book']);
Route::get('studio/booking/success', ['as' => 'studio.booking.success', 'uses' => 'StudioController@success']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
