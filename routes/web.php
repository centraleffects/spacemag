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

Route::get('/home', 'HomeController@index');


Route::name('dashboard')
	->middleware('auth')
	->get('/dashboard', 'AdminController@index');


Route::group(['prefix' => 'admin'], function () {
    Route::get('users', 'AdminController@index'); // Matches The "/admin/users" URL
});


