<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

// use App\Http\Requests\StoreUser;


use App\User;
use App\Shop;


class UserController extends Controller
{   

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
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = \Input::all();

        $validator = $this->verify($input);

        if ($validator->fails())
            return ['validation_errors' => $validator->messages()->messages(), 'success' => false];

        $user = new User;

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
    public function update(User $user)
    {
        $input = Input::all();
        
        $response = ['success' => 0];

        $validator = $this->verify($input);

        if ($validator->fails())
            return ['validation_errors' => $validator->messages()->messages(), 'success' => false];


        $user->address_1 = $input['address_1'];

        if( $user->save() )
            $response['success'] = 1; 

        return $response;
    }
    /*public function update(StoreUser $request){
        $input = Input::all();
        $response = ['success' => 0];

        $user->address_1 = $input['address_1'];

        if( $user->save() )
            $response['success'] = 1;

        return $response;
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    /**
     * Display list of users
     */
    public function getlist(){
        
        $limit = 30;
        $offset = 0;

        $users = User::limit($limit)->offset($offset)->get();

        return $users;
    }


    public function test(){
        $user = User::find(1);

        $shops = $user->shops()->first();

        dd($shops);
    }
    

    private function rules(){
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'role' => 'required',
            'address_1' => 'required',
            'address_2' => 'alpha_num',
            'city' => 'alpha_num',
            'zip_code' => 'required|numeric',
            'telephone' => 'required|numeric',
            'mobile' => 'required|numeric',
        ]; 
    }

    public function verify($input){
        return Validator::make($input, $this->rules());
    }
}
