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
Route::get('/', function(){
	return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');

// AUTH ONLY
Route::get('/event_search', 'EventController@all')->name('event_search');

// PORCULT ONLY
Route::get('/procult', 'HomeController@procult')->name('procult');
Route::post('/event_sub_procult/{id}', 'EventController@SubProCult')->name('event_sub_procult');
Route::get('/event_details_procult/{id}', 'EventController@showprocult')->name('event_details_procult');
Route::get('/event_sub_details_procult/{id}', 'GuardController@createProcult')->name('event_sub_details_procult');
Route::post('/event_sub_procult/{id}', 'GuardController@storeProcult')->name('event_sub_procult');
Route::get('/event_list_procult/', 'GuardController@index')->name('event_list_procult');

// PROGUARD ONLY
Route::get('/proguard', 'HomeController@proguard')->name('proguard');
Route::get('/event_sub_details_proguard/{id}', 'GuardController@create')->name('event_sub_details_proguard');
Route::post('/event_sub_proguard/{id}', 'GuardController@store')->name('event_sub_proguard');
Route::get('/event_list_proguard/', 'GuardController@index')->name('event_list_proguard');
Route::get('/guard_details_proguard/{id}', 'GuardController@show')->name('guard_details_proguard');
Route::get('/event_details_proguard/{id}', 'EventController@showproguard')->name('event_details_proguard');

// ORGA ONLY
Route::get('/orga', 'HomeController@orga')->name('orga');
Route::get('/event_creation', 'EventController@create')->name('event_form');
Route::post('/event_creation/post', 'EventController@store')->name('event_post');
Route::get('/event_list_orga', 'EventController@userall')->name('event_list_orga');
Route::get('/event_details_orga/{id}', 'EventController@showorga')->name('event_details_orga');

// ADMIN ONLY
Route::get('/admin', 'HomeController@admin')->name('admin');
