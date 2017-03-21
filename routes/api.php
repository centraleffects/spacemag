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
	
//     return $request->user();
// });


Route::get('users', 'UserController@index');
Route::get('users/{user}', 'UserController@show');

Route::group(['prefix' => 'test'], function(){
	Route::get('users', 'UserController@test');
});


Route::group(['prefix' => 'shops'], function (){
	Route::get('all', 'ShopController@index');
	Route::get('{$shop}', 'ShopController@show');
	Route::post('create', 'ShopController@create');
	Route::post('delete', 'ShopController@destroy');
});