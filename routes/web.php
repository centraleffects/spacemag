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
	->get('/dashboard', function (){
		// write your dashboard routes here
	});

Route::name('shop')
	->middleware('auth')
	->get('/shop', function (){
		// write routes for shop here
	});