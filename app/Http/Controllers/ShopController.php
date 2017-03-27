<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShop;

use App\Shop;
use Illuminate\Http\Request;
use App\User;
use Auth;

class ShopController extends Controller
{
    protected $rules;

    function __construct()
    {
        $this->rules = [
            "name" => "required"
        ];
    }

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
        //
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
        
        if( Request::isJson() ){
            if( $shop->delete() ){
                $response['success'] = 1;
            }
        }

        return $response;
    }


    /**
     * Display list of shops
     */
    public function admin_list(){
        $shops = Shop::all();
        return $shops;
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

    public function users(Shop $shop){
        return $shop->users()->paginate(10);
    }

}
