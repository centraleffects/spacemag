<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
	
//     return dd($request->user());
// });




Route::group(['prefix' => 'test', 'middleware' => 'auth:api'], function(){
	Route::get('users', 'UserController@test');
});


Route::group(['prefix' => 'shops', 'middleware' => 'auth:api'], function (){
	Route::get('/', 'ShopController@index');
	Route::get('{shop}', 'ShopController@show');
	Route::post('create', 'ShopController@create');
	Route::post('delete', 'ShopController@destroy');
	Route::get('{shop}/users', 'ShopController@users');
	Route::delete('{shop}/users/{user}/remove', 'ShopController@removeUser');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function (){
	//Users
	Route::get('/', 'UserController@index');
	Route::get('/list', 'UserController@getlist');
	Route::get('/{user}', 'UserController@show');

	Route::patch('/update', 'UserController@update');
	Route::post('/delete/{user}', 'UserController@destroy');
	Route::post('/store', 'UserController@store');

	Route::post('/resets-password', 'Illuminate\Foundation\Auth\SendsPasswordResetEmails@sendResetLinkEmail');

	//Shops
	Route::post('{user}/shops', 'ShopController@get');
});

Route::group(['prefix' => 'workers', 'middleware' => 'auth:api'], function (){
	Route::get('/', 'UserController@workers');
});