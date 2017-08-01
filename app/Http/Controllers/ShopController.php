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


        if( $loggedUser->isAdmin() ){

            if(!empty($input['newOwner']) && filter_var($input['newOwner'], FILTER_VALIDATE_EMAIL)){

                //retrieve user by email
                $user = User::where('email', $input['newOwner'])->first();
                if(!$user){
                     $createNewOwner = true;
                }

            }

            if($createNewOwner){
                $user = new User();
                $user->email = $input['newOwner'];
                $firstname = explode("@", $input['newOwner']);
                $firstname = preg_replace("/[^A-Za-z0-9 ]/", ' ', $firstname[0]);
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

                $user->plain_password = $password; // assign random password
                 
                
            }


            

        }        

        $shop->name = isset($input['name']) ? $input['name'] : '';
        $shop->description = isset($input['description']) ? $input['description'] : '';
        $shop->url = isset($input['url']) ? $input['url'] : '';
        if(isset($input['currency'])) $shop->currency = $input['currency'];
        $shop->slug = isset($input['slug']) ? $input['slug'] : "";
        if(isset($input['commission_article_sale'])) $shop->commission_article_sale = $input['commission_article_sale'];
        if(isset($input['commission_salespot'])) $shop->commission_salespot = $input['commission_salespot'];

        if(isset($input['spot_free_max_prebook'])) $shop->spot_free_max_prebook = $input['spot_free_max_prebook'];
        if(isset($input['spot_max_end_prebook'])) $shop->spot_max_end_prebook = $input['spot_max_end_prebook'];

        if( isset($input['cleanup_schedule']) && !empty($input['cleanup_schedule']) ){
            if( is_array($input['cleanup_schedule']) ){
                $shop->cleanup_schedule = implode(",",$input['cleanup_schedule']);
            }else if( is_string($input['cleanup_schedule']) ){
                $shop->cleanup_schedule = $input['cleanup_schedule'];
            }
        }
        
        $isAdd = isset($shop->id);

        $res = isset($shop->id) ? $shop->update() : $shop->save();

        if( $res ){

            $shop = Shop::where(['id' => $shop->id])->with('owners')->first();  
    
            $shopOwners = $shop->owners;
            $oldShopOwners = [];
            if($shopOwners){
                foreach( $shopOwners as $owner){
                    $oldShopOwners[] = $owner['email'];
                }
            }

            if( auth()->user()->isAdmin() && isset($input['removeOwner'])){
                //remove user
                if(is_array($input['removeOwner'])){
                    foreach($input['removeOwner'] as $owner){
                        $userO = User::where('email', $owner)->first();
                        if($userO){
                            $shop->owner()->detach($userO);
                        }
                    }
                }
            }

           if( auth()->user()->isAdmin() && isset($user) ){
                if(!in_array($user->email,$oldShopOwners)){
                    $shop->owner()->attach($user);
                    $email_response = $this->sendInviteEmail($shop, $user);
                    if(!$email_response){
                        $msg = "Email not sent.";
                    }
                }
            }
            if(!$isAdd){
                $msg = __("messages.shop_added");
            }else{
                $msg = __("messages.shop_updated");
            }
            

            $response['shops']  =  $this->getlist();
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

    public function updateFloorPlan(Request $request){
        $shop = session()->get('selected_shop');
        $input = Input::all();
        $file = $request->file('uploadFloorplan');

        if($file->getMimeType() === 'image/jpeg'){

            if(!is_dir(FLOOR_MAP)){
                mkdir(FLOOR_MAP, 0775);
              }
            $source = fopen($file->getPathname(), 'r');
            $destination = fopen(FLOOR_MAP.'img_'.$shop->id.'.jpg', 'w');

            stream_copy_to_stream($source, $destination);

            fclose($source);
            fclose($destination);

             return  redirect('/shop')->with('success', 'The floor plan image for '.$shop->name.' had been updated.');

        }else{
            return  redirect('/shop')->with('error', 'Please upload floor plan image in JPG/JPEG format only.');
        }
        dd($file);
    }
}
