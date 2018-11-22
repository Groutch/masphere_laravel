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

Auth::routes();

// ALL
Route::get('/', function(){
	return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');


// AUTH ONLY
Route::group(['middleware'=>'auth'], function () {
	//Route::get('/logout');
	Route::get('/profil/{id}','HomeController@getUsers')->name('profile');
	Route::get('/map_test', 'MapTestController@index')->name('map_test');
	Route::get('/edit/account','UserController@edit')->name('edit_account');
	Route::post('/edit/account','UserController@submit')->name('submit_account');
	// PORCULT ONLY
	Route::group(['middleware'=>'procult'], function () {
		Route::get('/procult', 'HomeController@procult')->name('procult');
		Route::post('/event_sub_procult/{id}', 'EventController@SubProCult')->name('event_sub_procult');
		Route::get('/event_details_procult/{id}', 'EventController@showprocult')->name('event_details_procult');
		Route::get('/event_sub_details_procult/{id}', 'GuardController@createProcult')->name('event_sub_details_procult');
		Route::post('/event_sub_procult/{id}', 'GuardController@storeProcult')->name('event_sub_procult');
		Route::get('/event_list_procult', 'GuardController@index')->name('event_list_procult');
		Route::get('/delete_urequest/{id}','UrequestController@delete')->name('delete_urequest');
	});

	// PROGUARD or PROCULT
	Route::group(['middleware'=>'pro'], function () {
		Route::get('/guard_details_pro/{id}', 'GuardController@show')->name('guard_details_pro');
		Route::get('/event_search', 'EventController@all')->name('event_search');
	});

	// PROGUARD ONLY
	Route::group(['middleware'=>'proguard'], function () {
		Route::get('/proguard', 'HomeController@proguard')->name('proguard');
		Route::get('/event_sub_details_proguard/{id}', 'GuardController@create')->name('event_sub_details_proguard');
		Route::post('/event_sub_proguard/{id}', 'GuardController@store')->name('event_sub_proguard');
		Route::get('/event_list_proguard/', 'GuardController@index')->name('event_list_proguard');
		Route::get('/event_details_proguard/{id}', 'EventController@showproguard')->name('event_details_proguard');
		Route::get('/guard_delete/{id}', 'GuardController@destroy')->name('guard_delete');
		Route::post('/accept/{id}','UrequestController@accept')->name('accept');
		Route::post('/reject/{id}','UrequestController@reject')->name('reject');
	});

	// ORGA ONLY
	Route::group(['middleware'=>'orga'], function(){
		Route::get('/orga', 'HomeController@orga')->name('orga');
		Route::get('/event_creation', 'EventController@create')->name('event_form');
		Route::get('/event_list_orga', 'EventController@userall')->name('event_list_orga');
		Route::get('/event_details_orga/{id}', 'EventController@showorga')->name('event_details_orga');
		Route::get('/event_edit/{id}', 'EventController@edit')->name('event_edit');
		Route::get('/event_delete/{id}', 'EventController@destroy')->name('event_delete');
		Route::post('/event_creation/post', 'EventController@store')->name('event_post');
		Route::post('/event_update/{id}', 'EventController@update')->name('event_update');
	});

	// ADMIN ONLY
	Route::group(['middleware'=>'orga'], function(){
		Route::get('/admin', 'HomeController@admin')->name('admin');
	});
});