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
	Route::get('list', 'ShopController@getlist');
	Route::get('list/{owner}', 'ShopController@getlist');
	Route::get('owners', 'ShopController@listOwners');
	Route::get('{shop}', 'ShopController@show');
	Route::get('{shop}/users', 'ShopController@users');
	Route::get('{shop}/workers', 'ShopController@workers');

	Route::get('{shop}/tasks', 'TodoTaskController@getByShop');

	Route::get('{shop}/tasks', 'TodoTaskController@getByShop');

	Route::delete('{shop}/users/{user}/remove', 'ShopController@removeUser');
	
	Route::post('create', 'ShopController@create');
	Route::post('delete', 'ShopController@destroy');
	Route::post('update', 'ShopController@update');
	Route::post('{shop}/users/{user}/passwordreset', 'ShopOwnerController@generatePassword');
	
	Route::post('{shop}/invite', 'ShopOwnerController@invite');
	Route::post('{shop}/workers/invite', 'ShopOwnerController@inviteWorker');
	Route::post('{shop}/newsletter-subscription/{user}', 'ShopOwnerController@toggleNewsletterSubscription');

});

Route::group(['prefix' => 'categories', 'middleware' => 'auth:api'], function(){
	Route::get('list', 'SalespotCategoryTypeController@getlist');
});

Route::group(['prefix' => 'articles', 'middleware' => 'auth:api'], function (){
	Route::get('/', 'ArticleController@index');
	Route::post('create', 'ArticleController@store');
	Route::post('delete', 'ArticleController@destroy');
	Route::post('update', 'ArticleController@update');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:api'], function (){
	//Users
	Route::get('/', 'UserController@index');
	Route::get('/list', 'UserController@getlist');
	Route::get('/{user}', 'UserController@show');

	Route::patch('/update', 'UserController@update');
	Route::post('/delete/{user}', 'UserController@destroy');
	Route::post('/store', 'UserController@store');

	//Shops (for shopowner)
	Route::get('{user}/shops', 'ShopController@get');

	Route::get('{user}/tasks', 'TodoTaskController@getByUser');

	
});

Route::group(['prefix' => 'workers', 'middleware' => 'auth:api'], function (){
	Route::get('/', 'UserController@workers');
});

Route::group(['prefix' => 'tasks', 'middleware' => 'auth:api'], function (){
	Route::post('store', 'TodoTaskController@store');
	Route::get('{task}', 'TodoTaskController@show');
	Route::delete('{task}/unassign', 'TodoTaskController@unAssign');
	Route::post('{task}/assign/{user}', 'TodoTaskController@assignTask');
	Route::post('{task}/update', 'TodoTaskController@update');
	Route::post('{task}/finish', 'TodoTaskController@toggleDone');
	Route::delete('{task}/delete', 'TodoTaskController@destroy');
	Route::post('clear', 'TodoTaskController@clearTasksByShop');
});