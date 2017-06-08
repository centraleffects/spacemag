<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Mail;

use App\Http\Requests\StoreShop;
use App\Helpers\Helper;
use App\Shop;
use App\User;

use App\Mail\ShopOwnerInvitation;

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
        $createNewOwner = false;
        $assignNewOwner = false;
        $input = Input::all();


        $loggedUser = auth()->guard('api')->user();

        if(isset($input['isNew'])){
            unset($input['id']);
            unset($input['isNew']);
            $shop = new Shop();
        }else{
           $shop = Shop::find($input['id']);  
        }

        if(!isset($input['user_id'])){
            $input['user_id'] = 1;
        }

        if( $loggedUser->isAdmin() ){



            $oldShopOwner = $input['user_id'];

            if(isset($input['owner'])){

                   $user = User::find($input['owner']['id']);
                   if($user){
                     if($user->email <> $input['owner']['email']){
                        if(trim($input['owner']['email']) == ""){
                            $createNewOwner = true;
                        }else{
                            $user = User::where('email', $input['owner']['email'])->first();
                            if(!$user){
                                $createNewOwner = true;
                            }else{
                                $shop->user_id = $user->id;
                            }
                        }
                        
                     }
                   }else{
                        //try with email
                        if(trim($input['owner']['email']) == ""){
                            $createNewOwner = true;
                        }else{
                            $user = User::where('email', $input['owner']['email'])->first();
                            if(!$user){
                                $createNewOwner = true;
                            }else{
                                $shop->user_id = $user->id;
                            }
                        }

                   }
                   
            } 

            if($createNewOwner){
                $user = new User();
                $user->email = $input['owner']['email'];
                $firstname = explode("@", $input['owner']['email']);
                $firstname = preg_replace("/[^A-Za-z0-9 ]/", '', $firstname[0]);
                $password = str_random(8);

                $user->first_name = $firstname;
                $user->last_name = "";
                $user->password  = bcrypt($password);
                $user->gender  ="";
                $user->telephone  = "";
                $user->mobile  = "";
                $user->social_security_id  = "";
                $user->address_1  ="";
                $user->address_2  = "";
                $user->city  = "";
                $user->zip_code  = "";
                $user->country  = "";
                $user->lang  = 'sv';
                $user->role = "owner";
                $user->api_token = str_random(60);
                $user->save();

                // $user = User::where('email', $input['owner']['email'])->first();
                $user->plain_password = $password; // assign random password
                

            }

            $shop->user_id = $user->id ?: 1;

        }        

        $shop->name = $input['name'];
        $shop->description = $input['description'];
        $shop->url = $input['url'];
        $shop->currency = $input['currency'];
        $shop->slug = isset($input['slug']) ? $input['slug'] : "";
        $shop->commission_article_sale = $input['commission_article_sale'];
        $shop->commission_salespot = $input['commission_salespot'];
        $shop->cleanup_schedule = implode(",",$input['cleanup_schedule']);

        if( $shop->update() ){
            if( $loggedUser->isAdmin() && ($oldShopOwner <> $user->id) ){ // send email 
                $email_response = $this->sendInviteEmail($shop, $user);
                if(!$email_response){
                    $msg = "Email not sent.";
                }

                $response['shop']['owner'] = $user;
            }
            
            $msg = __("messages.shop_updated");
            $response['owners'] = $this->listOwners();
            $response['shops']  =  $this->getlist();
            $response['shop'] = $shop;
            
            $response['success'] = 1;
            $response['msg'] = $msg;
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
            
            $shops = Helper::getShopWithTasks($user);

            return $shops;

        return [
            "error" => "Unauthorize access.", 
            "code" => 403, 
            "success" => false
        ];
    }

    //Send email invitation
    private function sendInviteEmail(Shop $shop, User $newOwner){

        $shop = Shop::find($shop)->first();
     
        try {
            $mail = new ShopOwnerInvitation($shop, $newOwner, Auth::guard('api')->user());

            Mail::to($newOwner->email)->send($mail);

            return true;

        } catch (\Exception $e) {

            return false;
            // return $e;  
        }

    }

 
    public function users(Shop $shop){
        return $shop->users()->where('role', '=', 'customer')->get();
    }

    public function workers(Shop $shop){
        return Helper::getShopWorkers($shop);
    }

    public function removeUser(Shop $shop, User $user){
        if( $shop->users()->detach($user) )
            return ['success' => 1];

        return ['success' => 0];
    }

    public function getlist(){
        $input = Input::all();
        if(!empty($input['id'])){
            $shops = Shop::where('user_id', '=', $input['id'])->with('owner')->paginate(50);
        }else{
            $shops = Shop::with('owner')->paginate(50);
        }
        return $shops;
    }

    public function listOwners(){
        $users =  User::where( ['role' => 'owner'] )->paginate(50);
        return $users;
    }

    public function loggedProfile(){
        return \Auth::user();
    }
}
