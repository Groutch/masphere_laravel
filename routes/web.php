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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// ALL
Route::get('/', 'HomeController@index')->name('home');

// AUTH ONLY
Route::get('/event_search', 'EventController@all')->name('event_search');
Route::get('/event_details/{id}', 'EventController@show')->name('event_details');

// PORCULT ONLY
Route::get('/procult', 'HomeController@procult')->name('procult');
Route::post('/event_sub_procult/{id}', 'EventController@SubProCult')->name('event_sub_procult');

// proguard ONLY
Route::get('/proguard', 'HomeController@proguard')->name('proguard');
Route::get('/event_sub_details_proguard/{id}', 'EventController@SubproguardDetails')->name('event_sub_details_proguard');
Route::post('/event_sub_proguard/{id}', 'EventController@Subproguard')->name('event_sub_proguard');

// ORGA ONLY
Route::get('/orga', 'HomeController@orga')->name('orga');
Route::get('/event_creation', 'EventController@create')->name('event_form');
Route::post('/event_creation/post', 'EventController@store')->name('event_post');
Route::get('/event_list_orga', 'EventController@userall')->name('event_list_orga');
Route::get('/event_details_orga/{id}', 'EventController@showorga')->name('event_details_orga');

// ADMIN ONLY
Route::get('/admin', 'HomeController@admin')->name('admin');
