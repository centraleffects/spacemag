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

Route::get('home', 'HomeController@index');
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

// Routes for Facebook Auth
Route::get('login/fb', 'Auth\LoginController@redirectToProvider');
Route::get('login/fb/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@index'); // Matches The "admin/" URL
    Route::get('/dashboard', 'AdminController@index');
    Route::get('/users', 'AdminController@users'); 
    Route::get('/shops', 'AdminController@shops'); 
    Route::get('/shops/{id?}', 'AdminController@spots'); 
    Route::get('/categories', 'AdminController@categories'); 
    Route::get('/transactions', 'AdminController@transactions'); 

    Route::get('/users/{id?}',['uses' =>'AdminController@users']);
    Route::get('/users/delete/{delete?}',['uses' =>'AdminController@users']);
    
    Route::get('/me',['uses' =>'AdminController@loggedProfile']);

    
});

Route::group(['prefix' => 'shop', 'middleware' => 'web' ], function (){
	Route::get('/', 'ShopOwnerController@index');
	Route::get('clients', 'ShopOwnerController@clients');
	Route::get('clients/articles', 'ShopOwnerController@articles');
	Route::get('customers', 'ShopOwnerController@customers')->middleware('owner');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');

	Route::get('/me',['uses' =>'AdminController@loggedProfile']);
});

Route::group(['middleware' => ['web']], function (){
	Route::get('shops/{shop}/subscribe', 'ShopOwnerController@subscribe');
	Route::get('shop/login-as/{user}/{shopId?}', 'ShopOwnerController@loginAsSomeone');
	Route::get('shop/login-back', 'ShopOwnerController@loginBack');
	Route::get('shop/set/{shop}', 'ShopOwnerController@setShopSession');
	Route::get('shop/spots', 'ShopOwnerController@spots');
	Route::get('shop/spots/{id}', 'ShopOwnerController@spots');

	Route::get('account', 'UserController@edit');
	Route::get('email/change', 'UserController@changeEmail');
});


Route::get('email/confirm/{token}', 'UserController@confirmEmail');

Route::get('test-event', function (){
	// $user = auth()->user();
	$user = App\User::first();
	event(new CustomerBecameAClient($user));
});


Route::get('try/{lang}', function ($lang){
	\App::setLocale($lang);
	
	echo \App::getLocale()."<br>";
	dd(__('messages.email_changed_confirmed'));
});

