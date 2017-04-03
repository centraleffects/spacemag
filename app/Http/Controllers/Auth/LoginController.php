<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/shop';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated($user)
    {

        if( auth()->user()->isAdmin() )
            return \Redirect::to('admin');

        return \Redirect::to('shop');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        $socialite = Socialite::driver('facebook');
        // dd($socialite);
        return $socialite->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $fb_user = Socialite::driver('facebook')->user();
        
        $client = new \GuzzleHttp\Client();

        $fields = 'first_name,last_name,gender';
        $url = "https://graph.facebook.com/v2.8/$fb_user->id?fields=$fields&oauth_token=$fb_user->token";
        $res = $client->get($url);

        $data = json_decode( $res->getBody()->getContents() );
        // $data = json_decode( file_get_contents($url) );

        // find the user with a facebok id
        $user = User::where('facebook_id', '=', $fb_user->id)->first();

        // login the user
        if( $user ){
            \Auth::loginUsingId($user->id);

            if( !auth()->user()->isAdmin() )
                return \Redirect::to('shop');

            return \Redirect::to('admin');
            
        }else{
            // create the user 
            $user = new User();
            $user->first_name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $fb_user->email;
            $user->gender = $data->gender;
            $user->facebook_id = $fb_user->id;
            $user->password = bcrypt(str_random(10)); // use a random password
            $user->api_token = str_random(60); // token that we will use for our api routes
            $user->avatar = $fb_user->avatar;
            $user->avatar_original = $fb_user->avatar_original;

            if( $user->save() ){
                \Auth::loginUsingId($user->id);
            }
        }
        
        return \Redirect::to('home');
        
    }
}
