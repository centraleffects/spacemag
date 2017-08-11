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
	Route::get('users', 'Api\UserController@test');
});

Route::group(['middleware' => 'auth:api'], function (){
	Route::group(['prefix' => 'shops'], function (){
			Route::get('/', 'Api\ShopController@index');
			Route::get('list', 'Api\ShopController@getlist');
			Route::get('list/{owner}', 'Api\ShopController@getlist');
			Route::get('owners', 'Api\ShopController@listOwners');
			Route::get('{shop}/users/{type}', 'Api\ShopController@users');
			Route::get('{shop}', 'Api\ShopController@show');
			Route::get('{shop}/users', 'Api\ShopController@users');
			Route::get('{shop}/workers', 'Api\ShopController@workers');

			Route::get('{shop}/tasks', 'Api\TodoTaskController@getByShop');

			Route::get('{shop}/tasks', 'Api\TodoTaskController@getByShop');
			Route::get('{shop}/tasks/count', 'Api\TodoTaskController@countNewTasks');

			Route::delete('{shop}/users/{user}/remove', 'Api\ShopController@removeUser');
		
			Route::post('create', 'Api\ShopController@create');
			Route::post('delete', 'Api\ShopController@destroy');
			Route::post('update', 'Api\ShopController@update');
		Route::post('{shop}/users/{user}/passwordreset', 'Api\ShopOwnerController@generatePassword');
		
		Route::post('{shop}/invite', 'Api\ShopOwnerController@invite');
		Route::post('{shop}/workers/invite', 'Api\ShopOwnerController@inviteWorker');
		Route::post('{shop}/newsletter-subscription/{user}', 'Api\ShopOwnerController@toggleNewsletterSubscription');

			Route::post('search', 'Api\ShopController@search');
		Route::post('{shop}/salespots/available', 'Api\SalespotController@getAvailableSaleSpot');

	});

	Route::group(['prefix' => 'categories'], function(){
		Route::get('list', 'Api\SalespotCategoryTypeController@getlist');
	});


	Route::group(['prefix' => 'salespot'], function(){
		Route::post('create', 'Api\SalespotController@store');
		Route::post('delete', 'Api\SalespotController@destroy');
		Route::post('update', 'Api\SalespotController@update');
		Route::get('list/{shop}', 'Api\SalespotController@getlist');
		Route::get('{salespot}/tasks', 'Api\SalespotController@getTasks');
	});


	Route::group(['prefix' => 'articles'], function (){
		Route::get('/', 'Api\ArticleController@index');
		Route::post('create', 'ArticleController@store');
		Route::post('delete', 'Api\ArticleController@destroy');
		Route::post('update', 'Api\ArticleController@update');
	});

	Route::group(['prefix' => 'users'], function (){
		//Users
		Route::get('/', 'Api\UserController@index');
		Route::get('/list', 'Api\UserController@getlist');
		Route::get('/{user}', 'Api\UserController@show');

		Route::patch('/update', 'Api\UserController@update');
		Route::post('/delete/{user}', 'Api\UserController@destroy');
		Route::post('/store', 'Api\UserController@store');

		//Shops (for shopowner)
			Route::get('{user}/shops', 'Api\ShopController@get');

		Route::get('{user}/tasks', 'Api\TodoTaskController@getByUser');

			Route::post('{user}/shop-add-remove/{shop}', 'Api\ShopController@addRemoveShop');
		Route::post('bookings/active', 'SalespotBookingController@getActiveBookings');

	});

	Route::group(['prefix' => 'workers'], function (){
		Route::get('/', 'Api\UserController@workers');
		// Route::get('{worker}/todos', '');
	});

	Route::group(['prefix' => 'tasks'], function (){
		Route::post('store', 'Api\TodoTaskController@store');
		Route::get('{task}', 'Api\TodoTaskController@show');
		Route::delete('{task}/unassign', 'Api\TodoTaskController@unAssign');
		Route::post('{task}/assign/{user}', 'Api\TodoTaskController@assignTask');
		Route::post('{task}/update', 'Api\TodoTaskController@update');
		Route::post('{task}/finish', 'Api\TodoTaskController@toggleDone');
		Route::delete('{task}/delete', 'Api\TodoTaskController@destroy');
		Route::post('clear', 'Api\TodoTaskController@clearTasksByShop');
	});


	Route::group(['prefix' => 'note'], function (){
		Route::get('/', 'Api\NoteController@index');
		Route::post('create', 'Api\NoteController@store');
		Route::post('delete', 'Api\NoteController@destroy');
		Route::post('update', 'Api\NoteController@update');
	});
});