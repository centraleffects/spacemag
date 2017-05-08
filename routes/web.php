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

Route::group(['prefix' => 'shop', 'middleware' => 'auth.basic' ], function (){
	Route::get('/', 'ShopOwnerController@index');
	Route::get('clients', 'ShopOwnerController@clients');
	Route::get('clients/articles', 'ShopOwnerController@articles');
	Route::get('customers', 'ShopOwnerController@customers')->middleware('owner');
	Route::get('todo', 'ShopOwnerController@todo');
	Route::get('workers', 'ShopOwnerController@workers');
	Route::get('workers/todo', 'ShopOwnerController@workersTodo');

	Route::get('/me',['uses' =>'AdminController@loggedProfile']);
});

Route::get('shops/{shop}/subscribe', 'ShopOwnerController@subscribe');
Route::get('shop/login-as/{user}/{shopId?}', 'ShopOwnerController@loginAsSomeone');
Route::get('shop/login-back', 'ShopOwnerController@loginBack')->middleware('auth.basic');
Route::get('shop/set/{shop}', 'ShopOwnerController@setShopSession')->middleware('auth.basic');
Route::get('shop/spots', 'ShopOwnerController@spots')->middleware('auth.basic');
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

Route::get('try', function (){
	// return session()->flush('selected_shop');
	$user = auth()->user();


	$res = $user->ownedShops()->with('todoTasks', 'todoTasks.owner', 'tasks', 'tasks.owner')->paginate(10);


	$res->each(function ($shop, $index){
		$t1 = collect($shop->tasks)->toArray();
		$t2 = collect( $shop->todoTasks )->toArray();
		$all_tasks = array_collapse([$t1, $t2]);

		$shop->all_tasks = $all_tasks;
	});

	dd($res);
	$new_res->toArray();

	$res->all_tasks = $new_res[0];
	dd($res);
	$tasks1 = collect($user->ownedShops()->with('todoTasks')->get())->map(function ($shop){
		return $shop->todoTasks()->get();
	});
	
	$tasks2 =  collect($user->ownedShops()->with('tasks')->get())->map(function ($shop){
		return $shop->tasks()->get();
	});
	
	$t1 = $tasks1[0]->merge($tasks2[0]);
	return $t1;
});

