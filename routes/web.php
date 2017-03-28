<?php
use App\Mail\Welcome;

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

// Routes for Facebook Auth
Route::get('login/fb', 'Auth\LoginController@redirectToProvider');
Route::get('login/fb/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'AdminController@index'); // Matches The "admin/" URL
    Route::get('/dashboard', 'AdminController@index'); // Matches The "admin/" URL); 
    Route::get('/users', 'AdminController@users'); 
    Route::get('/shops', 'AdminController@shops'); 
    Route::get('/categories', 'AdminController@categories'); 
    Route::get('/transactions', 'AdminController@transactions'); 

    Route::get('/users/{id?}',['uses' =>'AdminController@users']);
    Route::get('/users/delete/{delete?}',['uses' =>'AdminController@users']);
    
    Route::get('/me',['uses' =>'AdminController@loggedProfile']);

     //API calls for admin
    Route::get('/shops/list', 'ShopController@admin_list'); 
    
});

Route::group(['prefix' => 'shop', 'middleware' => 'owner'], function (){
	Route::get('/', 'ShopOwnerController@index');
	Route::get('clients', 'ShopOwnerController@clients');
	Route::get('clients/articles', 'ShopOwnerController@articles');
	Route::get('customers', 'ShopOwnerController@customers');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');
});


Route::get('test-event', function (){
	// $user = auth()->user();
	$user = App\User::first();
	event(new CustomerBecameAClient($user));
});

Route::get('test-mail', function (){
	$user = App\User::first();
	Mail::to($user->email)->send(new Welcome);
});

/**
 * Store the incoming blog post.
 *
 * @param  StoreUser  $request
 * @return Response
 */
Route::get('try', function (){
	// dd($request);
	// Route for testing purposes
	// do your quick algorithm test here
	
	// $shop = new App\Shop;
	// $shop->name = "Rebuy Shop";
	// $shop->description = "";
	// $shop->url = "";
	// $shop->currency = "";
	
	// auth()->user()->shops()->save($shop);

	// dd($shop);

	return [
        'client_id' => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect' => env('FB_REDIRECT'),
    ];

});