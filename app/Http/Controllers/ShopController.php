<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests\StoreShop;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;

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


    public function get(User $user){
        if( Auth::guard('api')->user()->id == $user->id )
            return $user->shops()->paginate(10);

        return [
            "error" => "Unauthorize access.", 
            "code" => 403, 
            "success" => false
        ];
    }

    // Shop customers
    public function users(Shop $shop){
        return $shop->users()->get();
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

    public function invite(Shop $shop, ShopInvitationRequest $request){
        try {
            $input = Input::all();

            $user = User::where('email', '=', $input['email'])->first();

            $password = str_random(8);

            if( !$user ){
                $user = new User;
                $user->first_name = $input['name'];
                $user->last_name = "";
                $user->password = bcrypt($password);
                $user->email = $input['email'];
                $user->api_token = str_random(60);
                $user->role = 'customer';
                $user->save();
                $user->plain_password = $password;
            }

            $mail = new ShopInvitation($shop, $user);

            Mail::to($input['email'])->send($mail);

            return ['success' => 1];

        } catch (\Exception $e) {
            return ['success' => 0];
        }
    }
}
