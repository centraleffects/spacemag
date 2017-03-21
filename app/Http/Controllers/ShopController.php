<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop_owner.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Request::isJson() ){ // only process json request
            $input = Input::all();

            $shop = new Shop;
            $shop->name = $input['name'];
            $shop->description = $input['description'];
            $shop->url = $input['url'];
            $shop->currency = $input['currency'];
            // $shop->user_id = auth()->user()->id;
            $shop->attach(auth()->user());

            $shop->save();
        }

        return false;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Shop::create(array(
            'name' => Input::get('name'),
            'description' => Input::get('description')
        ));

        return Response::json(array('success' => true));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
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

}
