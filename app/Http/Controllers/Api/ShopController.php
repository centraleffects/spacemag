<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $response = ['success' => 0, 'msg' =>''];
        
        $input = Input::all();

        $shop = Shop::find($input['id']);  

        if( $shop->delete() ){
            $response['success'] = 1;
            $response['msg'] = __("messages.shop_updated");
        }
        $response['shops']  =  $this->getlist();
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

        $shop = Shop::where(['id' => $shop->id])->first();
     
        try {
            $mail = new ShopOwnerInvitation($shop, $newOwner, Auth::guard('api')->user());

            Mail::to($newOwner->email)->send($mail);

            return true;

        } catch (\Exception $e) {

            return false;
            // return $e;  
        }

    }

 
    public function users(Shop $shop, $type = null){
        if(!$type){
            return $shop->users()->where('role', '=', 'customer')->get();
        }else{
            return $shop->users()->where('role', '=', $type)->with('notes')->get();
        }
        
    }


    public function removeUser(Shop $shop, User $user){
        if( !$user->isOwner() and !$user->isAdmin() )
            return ['success' => 0, 'msg' => __("erros.unauthorize")];

        if( $shop->users()->detach($user) )
            return ['success' => 1];

        return ['success' => 0];
    }

    /**
    * @param integer shop_id
    * @param integer user_id
    * @param string  action = add, remove
    */
    public function addRemoveShop(User $user, Shop $shop){
        $action = Input::get('action');
        $msg = "";
        if( $action == "remove" && $user->shops->contains($shop->id) ){
            $msg = __('messages.shop_removed', ['shop_name' => $shop->name]);
        }else{
            $msg = __('messages.shop_added_to_list', ['shop_name' => $shop->name]);

            if( $user->shops->contains($shop->id) ){
                return ['success' => 0, 'msg' => __("errors.shop_already_in_listing")];
            }

        }

        $res = $user->shops()->toggle($shop->id);

        if( $res )

            return  ['success' => 1, 'msg' => $msg];

        return  ['success' => 0, 'msg' => __('erros.process_failed'), 'debug' => 'ShopController@addRemoveShop'];
        
        
    }


    public function getlist(){
        $input = Input::all();
        if(!empty($input['owner']['id'])){
            // $shops = Shop::where('user_id', '=', $input['id'])->with('owner')->paginate(50);
            $user = User::find($input['owner']['id']);
            if( isset($user->id) ){
                $shops = $user->ownedShops()->paginate(50);
            }
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

    public function search(){
        $input = Input::all();
        $searchTerms = $input['keyword'];

        $searchTerms = explode(' ', $searchTerms);
        $query = Shop::query();

        foreach($searchTerms as $searchTerm){
            $query->where(function($q) use ($searchTerm){
                $q->where('name', 'like', '%'.$searchTerm.'%')
                ->orWhere('description', 'like', '%'.$searchTerm.'%');
                // and so on
            });
        }

        $results = $query->get();

        if( count($results) < 1 ){
            return ['msg' => __("No result to display")];
        }

        return $results;
    }


    public function workers(Shop $shop){
        return $shop->workers()->get();
    }
    
}
