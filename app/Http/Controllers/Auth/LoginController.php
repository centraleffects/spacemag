<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Config;

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
        $this->setUserLocalization($user);

        if( session()->has('url.intended') ){
            return redirect()->intended( session()->get('url.intended') );
        }

        if( auth()->user()->isAdmin() )
            return \Redirect::to('/dashboard');

        return \Redirect::to('shop');
    }

    protected function setUserLocalization($user){
        if( isset($user->lang) && array_key_exists($user->lang, Config::get('languages')) ){
            session()->put('applocale', $user->lang);
        }
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        $socialite = Socialite::driver('facebook');
        return $socialite->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $socialite = Socialite::driver('facebook');
        $fb_user = $socialite->user();

        $client = new \GuzzleHttp\Client();

        $fields = 'first_name,last_name,gender';
        $url = "https://graph.facebook.com/v2.8/me?fields=$fields&oauth_token=$fb_user->token";
        $res = $client->get($url);

        $data = json_decode( $res->getBody()->getContents() );

        // find the user with a facebok id
        $user = User::where('facebook_id', '=', $fb_user->id)->first();

        // login the user
        if( $user ){
            \Auth::loginUsingId($user->id);

            $this->setUserLocalization($user);

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
            $user->role = 'customer';

            if( $user->save() ){
                $this->setUserLocalization($user);
                \Auth::loginUsingId($user->id);
            }
        }
        
        return \Redirect::to('home');
        
    }
}
