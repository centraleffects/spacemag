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
   
    Route::get('/transactions', 'AdminController@transactions'); 

    Route::get('/users/{id?}',['uses' =>'AdminController@users']);
    Route::get('/users/delete/{delete?}',['uses' =>'AdminController@users']);
    
    Route::get('/me',['uses' =>'AdminController@loggedProfile']);

    Route::group(['prefix' => 'categories'], function (){
    	Route::get('/', 'AdminController@categories'); 
	    Route::get('delete/{category}', ['uses' =>'AdminController@categories']); 
	    Route::get('{id}', ['uses' =>'AdminController@categories']); 
	    Route::post('new', ['uses' =>'AdminController@categories']); 
    });
    
});

Route::group(['prefix' => 'shop', 'middleware' => ['owner'] ], function (){
	Route::get('/', 'ShopOwnerController@index');

	Route::get('customers', 'ShopOwnerController@customers');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');

	Route::get('/me',['uses' =>'AdminController@loggedProfile']);

	Route::group(['prefix' => 'clients'], function (){
		Route::get('/',['uses' =>'ClientController@indexOwner']);
		Route::get('{id}',['uses' =>'ClientController@indexOwner']);
		Route::get('new',['uses' =>'ClientController@indexOwner']);
	});

	Route::group(['prefix' => 'coupons'], function (){
		Route::get('new',['uses' =>'ShopCouponController@indexOwner']);
		Route::get('/',['uses' =>'ShopCouponController@indexOwner']);
		Route::get('{id}',['uses' =>'ShopCouponController@indexOwner']);
		Route::get('delete/{id}',['uses' =>'ShopCouponController@destroy']);
	});

});


Route::group(['middleware' => 'web'], function (){
	Route::get('shops/{shop}/subscribe', 'ShopOwnerController@subscribe');

	Route::group(['prefix' => 'shop'], function (){
		Route::get('login-as/{user}/{shopId?}', 'ShopOwnerController@loginAsSomeone');
		Route::get('login-back', 'ShopOwnerController@loginBack');
		Route::get('set/{shop}', 'ShopOwnerController@setShopSession');
		Route::get('spots', 'ShopOwnerController@spots');
		Route::get('spots/{id}', 'ShopOwnerController@spots');

		Route::get('/tags/query', 'TagController@query');

		Route::group(['prefix' => 'articles'], function (){
			Route::get('/',['uses' =>'ArticleController@indexOwner']);
			Route::get('{id}',['uses' =>'ArticleController@indexOwner']);
			Route::get('new',['uses' =>'ArticleController@indexOwner']);
		});
	});

	Route::get('account', 'UserController@edit');
	Route::get('email/change', 'UserController@changeEmail');
	Route::get('users/activation/{confirmation_code}', 'UserController@verifyEmail');

	Route::post('profile/update', 'UserController@update');
	Route::post('profile/change/password', 'UserController@updatePassword');
	// Route::post('profile/change/email', 'UserController@updateEmail');
	Route::post('profile/change/email/request', 'UserController@changeEmail');
	Route::get('profile/confirm/email/{token}', 'UserController@confirmEmail');
	Route::post('profile/change/avatar', 'UserController@updateAvatar');
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

Route::get('try', function (){
	
});

