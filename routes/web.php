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
// Route::group(['domain' => 'admin.'.env('APP_DOMAIN'), 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
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

Route::group(['prefix' => 'shop', 'middleware' => ['owner'] ], function (){
	Route::get('/', 'ShopOwnerController@index');

	Route::get('customers', 'ShopOwnerController@customers');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');

	Route::get('/me',['uses' =>'AdminController@loggedProfile']);

	Route::get('/articles',['uses' =>'ArticleController@indexOwner'])->middleware(['owner']);
	Route::get('/articles/{id}',['uses' =>'ArticleController@indexOwner'])->middleware(['owner']);

	Route::get('/tags/query', 'TagController@query');

	Route::post('/articles',['uses' =>'ArticleController@indexOwner'])->middleware(['owner']);
	Route::post('/articles/{id}',['uses' =>'ArticleController@indexOwner'])->middleware(['owner']);

	Route::get('/articles/new',['uses' =>'ArticleController@indexOwner'])->middleware(['owner']);

	Route::get('/clients',['uses' =>'ClientController@indexOwner'])->middleware(['owner']);
	Route::get('/clients/{id}',['uses' =>'ClientController@indexOwner'])->middleware(['owner']);
	Route::get('/clients/new',['uses' =>'ClientController@indexOwner'])->middleware(['owner']);

	Route::post('/clients/{id}',['uses' =>'ClientController@indexOwner'])->middleware(['owner']);

	Route::get('/coupons/new',['uses' =>'ShopCouponController@indexOwner'])->middleware(['owner']);
	Route::get('/coupons',['uses' =>'ShopCouponController@indexOwner'])->middleware(['owner']);
	Route::post('/coupons',['uses' =>'ShopCouponController@indexOwner'])->middleware(['owner']);
	Route::get('/coupons/{id}',['uses' =>'ShopCouponController@indexOwner'])->middleware(['owner']);

	Route::post('/coupons/{id}',['uses' =>'ShopCouponController@indexOwner'])->middleware(['owner']);


	Route::get('/coupons/delete/{id}',['uses' =>'ShopCouponController@destroy'])->middleware(['owner']);

});

Route::group(['middleware' => 'web'], function (){
	Route::get('shops/{shop}/subscribe', 'ShopOwnerController@subscribe');
	Route::get('shop/login-as/{user}/{shopId?}', 'ShopOwnerController@loginAsSomeone');
	Route::get('shop/login-back', 'ShopOwnerController@loginBack');
	Route::get('shop/set/{shop}', 'ShopOwnerController@setShopSession');
	Route::get('shop/spots', 'ShopOwnerController@spots');
	Route::get('shop/spots/{id}', 'ShopOwnerController@spots');

	Route::get('account', 'UserController@edit');
	Route::get('email/change', 'UserController@changeEmail');
});


Route::group(['middleware' => 'client'], function (){
	Route::get('my-shops', 'ClientController@myShops');
	Route::get('shops/view/{shop}', 'ClientController@viewShop');
	Route::get('bookings', 'ClientController@bookings');
});

Route::get('email/confirm/{token}', 'UserController@confirmEmail');

Route::get('test-event', function (){
	// $user = auth()->user();
	$user = App\User::first();
	event(new CustomerBecameAClient($user));
});


Route::group(['domain' => 'workers.'.env('APP_DOMAIN')], function () {
    Route::get('hello', function () {
        dd(parse_url(Request::root(), PHP_URL_HOST));
    });
});

Route::get('try/{shop}', function (App\Shop $shop){
	$a = App\Helpers\Helper::getAvailableSaleSpots($shop);
	dd($a);
});

