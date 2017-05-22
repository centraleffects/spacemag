<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use Auth;
use Mail;

use App\Http\Requests\StoreUser;
use App\Mail\EmailChangeRequest;

use App\User;
use App\Shop;
use App\EmailVerification;


class UserController extends Controller
{   
    protected $rules;

    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate(50);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $input = Input::all();

        $user = new User;

        $response = ['success' => 0];

        $user->first_name  = $input['first_name'];
        $user->last_name  = $input['last_name'];
        $user->email  = $input['email'];
        $user->gender  = $input['gender'];
        $user->role  = $input['role'];
        $user->telephone  = $input['telephone'];
        $user->mobile  = $input['mobile'];
        $user->social_security_id  = !empty($input['social_security_id']) ? $input['social_security_id'] : '';
        $user->address_1  = $input['address_1'];
        $user->address_2  = !empty($input['address_2']) ? $input['address_2'] : '';
        $user->city  = $input['city'];
        $user->zip_code  = $input['zip_code'];
        $user->country  = $input['country'];
        $user->lang  = $input['lang'];

        $user->password = bcrypt($input['password']);

        $user->api_token = str_random(60);

        if( $user->save() ){

            $response['success'] = 1; 
        }

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    public function edit(){
        if( auth()->check() ){
            $user = auth()->user();
        }

        return view('profile')->withUser($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request){
        $input = Input::all();

        $response = ['success' => 0];

        $user = User::find($input['id']);
        
        $user->first_name  = $input['first_name'];
        $user->last_name  = $input['last_name'];
       // $user->email  = $input['email'];
        $user->gender  = $input['gender'];
        $user->role  = $input['role'];
        $user->telephone  = $input['telephone'];
        $user->mobile  = $input['mobile'];
        //$user->social_security_id  = $input['social_security_id'];
        $user->address_1  = $input['address_1'];
        $user->address_2  = $input['address_2'];
        $user->city  = $input['city'];
        $user->zip_code  = $input['zip_code'];
        $user->country  = $input['country'];
        $user->lang  = $input['lang'];

        if( $user->update() ){

            $response['success'] = 1; 
        }

        return $response;
    }

    // Requests to change email
    public function changeEmail(User $user){
        $new_email = Input::get($email);

        $verify = new EmailVerification();
        $verify->token = str_random(64);

        $mail = new EmailChangeRequest();
        try {
            Mail::to($user->email)->send($mail);

            return redirect()->back()->withFlash_message([
                'type' => 'success',
                'msg' => __('messages.email_changed_confirmed', ['new_meail' => $verify->email]),
                'important' => true
            ]);
        } catch (\Exception $e) {
            
        }
        
    }

    public function confirmEmail($token){
        $verify = EmailVerification::where(['token', '=', $token])->first();
        if( isset($verify->id) ){
            $user = User::find($verify->user_id);
            $old_email = $user->email;
            $user->email = $verify->email;

            if( $user->update() ){
                $verify->delete();
                // send notification email
                try {
                    $mail = new EmailConfirmationSuccessful($user, $old_email);
                    Mail::to($old_email)->send($mail);

                } catch (\Exception $e) {
                    
                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)

    {   

        if( $user->delete() )
            return ['success' => 1];
        
        return ['success' => 0];

    }


    /**
     * Display list of users
     */
    public function getlist(){

	   $users = User::paginate(50);

        return $users;
    }

    public function test(){
        $user = User::find(1);

        $shops = $user->shops()->first();

        dd($shops);
    }

    public function shops(User $user){
        return $user->ownedShops()->get();
    }
}
