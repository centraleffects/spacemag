<?php

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

Route::get('test', function (){
	App::setLocale('sv');
	dd(session()->has('applocale'));
	dd(App::getLocale());

});

Route::group(['prefix' => 'test'], function(){
	Route::get('users', 'UserController@test');
});


Route::group(['middleware' => 'auth:api'], function (){
	Route::group(['prefix' => 'shops'], function (){
		Route::get('/', 'ShopController@index');
		Route::get('list', 'ShopController@getlist');
		Route::get('list/{owner}', 'ShopController@getlist');
		Route::get('owners', 'ShopController@listOwners');
		Route::get('{shop}/users/{type}', 'ShopController@users');
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

		Route::post('search', 'ShopController@search');
		Route::post('{shop}/salespots/available', 'SalespotController@getAvailableSaleSpot');

	});

	Route::group(['prefix' => 'categories'], function(){
		Route::get('list', 'SalespotCategoryTypeController@getlist');
	});


	Route::group(['prefix' => 'salespot'], function(){
		Route::post('create', 'SalespotController@store');
		Route::post('delete', 'SalespotController@destroy');
		Route::post('update', 'SalespotController@update');
		Route::get('list/{shop}', 'SalespotController@getlist');
	});


	Route::group(['prefix' => 'articles'], function (){
		Route::get('/', 'ArticleController@index');
		Route::post('create', 'ArticleController@store');
		Route::post('delete', 'ArticleController@destroy');
		Route::post('update', 'ArticleController@update');
	});

	Route::group(['prefix' => 'users'], function (){
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

		Route::post('{user}/shop-add-remove/{shop}', 'ShopController@addRemoveShop');
		Route::post('bookings/active', 'SalespotBookingController@getActiveBookings');

	});

	Route::group(['prefix' => 'workers'], function (){
		Route::get('/', 'UserController@workers');
		// Route::get('{worker}/todos', '');
	});

	Route::group(['prefix' => 'tasks'], function (){
		Route::post('store', 'TodoTaskController@store');
		Route::get('{task}', 'TodoTaskController@show');
		Route::delete('{task}/unassign', 'TodoTaskController@unAssign');
		Route::post('{task}/assign/{user}', 'TodoTaskController@assignTask');
		Route::post('{task}/update', 'TodoTaskController@update');
		Route::post('{task}/finish', 'TodoTaskController@toggleDone');
		Route::delete('{task}/delete', 'TodoTaskController@destroy');
		Route::post('clear', 'TodoTaskController@clearTasksByShop');
	});


	Route::group(['prefix' => 'note'], function (){
		Route::get('/', 'NoteController@index');
		Route::post('create', 'NoteController@store');
		Route::post('delete', 'NoteController@destroy');
		Route::post('update', 'NoteController@update');
	});
});