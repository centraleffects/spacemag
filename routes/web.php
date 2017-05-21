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

    Route::get('/categories/delete/{category}', ['uses' =>'AdminController@categories']); 
    Route::get('/categories/{id}', ['uses' =>'AdminController@categories']); 

    Route::post('/categories/new', ['uses' =>'AdminController@categories']); 
    
});

Route::group(['prefix' => 'shop', 'middleware' => 'auth.basic' ], function (){
	Route::get('/', 'ShopOwnerController@index');
	Route::get('clients', 'ShopOwnerController@clients');
	Route::get('clients/articles', 'ShopOwnerController@articles');
	Route::get('customers', 'ShopOwnerController@customers')->middleware('owner');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');

	Route::get('/me',['uses' =>'AdminController@loggedProfile']);

	Route::get('/articles',['uses' =>'ArticleController@indexOwner'])->middleware('owner');
	Route::get('/articles/{id}',['uses' =>'ArticleController@indexOwner'])->middleware('owner');

	Route::get('/tags/query', 'TagController@query')->middleware('owner');
	Route::get('/tags/query/{query}', 'TagController@query')->middleware('owner');
});

Route::get('shops/{shop}/subscribe', 'ShopOwnerController@subscribe');
Route::get('shop/login-as/{user}/{shopId?}', 'ShopOwnerController@loginAsSomeone');
Route::get('shop/login-back', 'ShopOwnerController@loginBack')->middleware('auth.basic');
Route::get('shop/set/{shop}', 'ShopOwnerController@setShopSession')->middleware('auth.basic');
Route::get('shop/spots', 'ShopOwnerController@spots')->middleware('owner');
Route::get('shop/spots/{id}', 'ShopOwnerController@spots')->middleware('auth.basic');

Route::get('test-event', function (){
	// $user = auth()->user();
	$user = App\User::first();
	event(new CustomerBecameAClient($user));
});

Route::get('test-mail', function (){
	$user = App\User::first();
	Mail::to($user->email)->send(new Welcome);
});

Route::get('try/{lang}', function ($lang){
	\App::setLocale($lang);

	echo \App::getLocale()."<br>";
	echo "user lang: ".auth()->user()->lang;
	echo( __('I love programming.') );
	dd( __("You are loggedin as :role - ", ['role' => auth()->user()->role]) );
});

