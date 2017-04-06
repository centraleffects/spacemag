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
	
	return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "sendmail", "mailgun", "mandrill", "ses",
    |            "sparkpost", "log", "array"
    |
    */

    'driver' => env('MAIL_DRIVER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Address
    |--------------------------------------------------------------------------
    |
    | Here you may provide the host address of the SMTP server used by your
    | applications. A default option is provided that is compatible with
    | the Mailgun mail service which will provide reliable deliveries.
    |
    */

    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Port
    |--------------------------------------------------------------------------
    |
    | This is the SMTP port used by your application to deliver e-mails to
    | users of the application. Like the host we have set this value to
    | stay compatible with the Mailgun e-mail application by default.
    |
    */

    'port' => env('MAIL_PORT', 587),

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | E-Mail Encryption Protocol
    |--------------------------------------------------------------------------
    |
    | Here you may specify the encryption protocol that should be used when
    | the application send e-mail messages. A sensible default using the
    | transport layer security protocol should provide great security.
    |
    */

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Server Username
    |--------------------------------------------------------------------------
    |
    | If your SMTP server requires a username for authentication, you should
    | set it here. This will get used to authenticate with your server on
    | connection. You may also set the "password" value below this one.
    |
    */

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Sendmail System Path
    |--------------------------------------------------------------------------
    |
    | When using the "sendmail" driver to send e-mails, we will need to know
    | the path to where Sendmail lives on this server. A default path has
    | been provided here, which will work well on most of your systems.
    |
    */

    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];

});