<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


use Auth;

use App\Http\Requests\StoreUser;

use App\User;
use App\Shop;


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


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        if(!$user){
            if(!$input['id']){
                return [ 'success' => 0 ];
            }else{
                $user = User::find($input['id']);
            }
            
         }

         if($user->trashed()){
            return [ 'success' => 1 ];
         }

         
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
}
