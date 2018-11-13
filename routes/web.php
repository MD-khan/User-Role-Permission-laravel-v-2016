<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

	Auth::routes();


Route::group(['middleware' => ['auth']], function() {

	Route::get('/home', 'HomeController@index');

	//users
	Route::get('users','UserController@index');
	Route::get('users/create','UserController@create');
	Route::post('users/store','UserController@store');
	Route::get('users/{user}/show','UserController@show');
	Route::get('users/{user}/edit','UserController@edit');
	Route::patch('users/{user}/update','UserController@update');
	
//Role

	//Route::get('/roles', 'RoleController@index');
	 Route::get('/roles', 
	 	['middleware' => ['permission:role-list'], 
	 	'uses' => 'RoleController@index']);

	 Route::get('/roles/create', 
	 	['middleware' => ['permission:role-create'], 
	 	'uses' => 'RoleController@create']);

	 Route::get('/roles/store', 
	 	['middleware' => ['permission:role-create'], 
	 	'uses' => 'RoleController@store']);

	//Route::get('/roles/create', 'RoleController@create');

	//Route::post('/roles/store', 'RoleController@store');

	Route::get('/roles/{role}', 'RoleController@show');

	//Route::get('/roles/{role}/edit', 'RoleController@edit');

	 Route::get('/roles/{role}/edit',
	 	['middleware' => ['permission:role-create'], 
	 	'uses' => 'RoleController@edit']);

	Route::post('/roles/{role}/update', 'RoleController@update');
	Route::delete('/roles/{role}/destroy', 'RoleController@destroy');
 });