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
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function (){
	Route::get('/', 'UserController@index');
	Route::get('/list', 'UserController@getlist');
	Route::get('{user}', 'UserController@show');
	Route::post('update/', 'UserController@update');
	Route::post('{user}/shops', 'ShopController@get');
});