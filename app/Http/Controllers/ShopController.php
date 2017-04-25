<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;

use App\Http\Requests\StoreShop;
use App\Shop;
use App\User;


class ShopController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::guard('api')->check() && Auth::guard('api')->user()->isAdmin() )
            return Shop::all();
        return Auth::guard('api')->user()->shops()->paginate(10);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        $input = Input::all();

        $shop = new Shop;
        $shop->name = $input['name'];
        $shop->description = $input['description'];

        Auth::guard('api')->user()->shops()->save($shop);

        return array('success' => true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return $shop;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShop $request)
    {
        $response = ['success' => 0];
        $input = Input::all();
        if(isset($input['isNew'])){
            unset($input['id']);
            unset($input['isNew']);
            $shop = new Shop();
        }else{
           $shop = Shop::find($input['id']);  
        }

         if(!isset($input['user_id'])){
                $input['user_id'] = 0;
            }

        foreach($input as $k=>$v){

            if($v<>'' and $k <> '$$hashKey' and $k <> 'api_token'){
                $shop->{$k} = $v;
            }
        }
       
        if( $shop->save() ){
            $response['success'] = 1;
        }
        

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $response = ['success' => 0];
        
        $input = Input::all();

        $shop = Shop::find($input['id']);  

        if( $shop->delete() ){
            $response['success'] = 1;
        }

        return $response;
    }


    public function get(User $user){
        if( Auth::guard('api')->user()->id == $user->id )
            return $user->shops()->paginate(10);

        return [
            "error" => "Unauthorize access.", 
            "code" => 403, 
            "success" => false
        ];
    }

    // Shop customers  $shop->users()->where('role', '=', 'worker')->get()
    public function users(Shop $shop){
        return $shop->users()->where('role', '=', 'customers')->get();
    }

    public function workers(Shop $shop){
        return $shop->users()->where('role', '=', 'worker')->get();
    }

    public function removeUser(Shop $shop, User $user){
        if( $shop->users()->detach($user) )
            return ['success' => 1];

        return ['success' => 0];
    }

    public function getlist(){

        $shops = Shop::paginate(50);

        return $shops;
    }

    public function listOwners(){
        $users =  User::where( ['role' => 'owner'] )->get();
        return $users;
    }

    public function loggedProfile(){
        return \Auth::user();
    }
}
