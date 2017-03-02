<?php
use App\Mail\Welcome;

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


Route::name('admin')
	->middleware('auth')
	->get('/admin', 'AdminController@index');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('users', 'AdminController@index'); // Matches The "/admin/users" URL
});


Route::group(['prefix' => 'shop', 'middleware' => ['owner', 'client']], function (){
	Route::get('/', function (){
		return "Hello world!";
	});
});


Route::get('/test-event', function (){
	// $user = auth()->user();
	$user = App\User::first();
	event(new CustomerBecameAClient($user));
});

Route::get('/test-mail', function (){
	$user = App\User::first();
	Mail::to($user->email)->send(new Welcome);
});