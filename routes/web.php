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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ALL
Route::get('/home', 'HomeController@index')->name('home');

// AUTH ONLY
Route::get('/event_search', 'EventController@all')->name('event_search');

Route::get('/test', 'HomeController@test')->name('test');

// PORCULT ONLY
Route::get('/procult', 'HomeController@procult')->name('procult');

// PROGARD ONLY
Route::get('/progard', 'HomeController@progard')->name('progard');

// ORGA ONLY
Route::get('/orga', 'HomeController@orga')->name('orga');
Route::get('/event_creation', 'EventController@create')->name('event_form');
Route::post('/event_creation/post', 'EventController@store')->name('event_post');
Route::get('/event_list_orga', 'EventController@userall')->name('event_list_orga');

// ADMIN ONLY
Route::get('/admin', 'HomeController@admin')->name('admin');
