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
        $input = \Input::all();

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

    public function update(StoreUser $request){
        $input = Input::all();
        dd($input);
        $response = ['success' => 0];

        $user = Auth::guard('api')->user();
        //dd($input['data']);

       // $user->address_1 = $input['address_1'];
        foreach($input['data'] as $key => $val){
            if($val <>""){
                $user->{$key} = $val;
            }
        }

        if( $user->update() )
            $response['success'] = 1; 

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
        $user->delete();
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
