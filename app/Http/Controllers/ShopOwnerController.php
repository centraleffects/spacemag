<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use JavaScript;
use Mail;

use App\Shop;
use App\User;
use App\Salespot;
use App\Mail\PasswordReset;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;
use App\Mail\ShopWorkerInvitation;

class ShopOwnerController extends Controller
{

    public function includeUserOnJS()
    {
        $shops = auth()->user()->ownedShops()->get();
        $shop = session()->put('shops', $shops);

        if( !session()->has("selected_shop") && auth()->check() ){
            $shop = auth()->user()->ownedShops()->with('todoTasks')
                        ->with('todoTasks.owner')->first();
            session()->put("selected_shop", $shop);
        }

        $shop = session()->get('selected_shop');
        

        JavaScript::put([
            'user' => auth()->user(),
            'selectedShop' => $shop
        ]);
    }

    public function index(){
        $this->includeUserOnJS();
        
    	return view('shop_owner.dashboard');
    }

    public function clients(){
        $this->includeUserOnJS();
    	return view('shop_owner.clients');
    }

    public function articles(){
        $this->includeUserOnJS();
    	return view('shop_owner.articles');
    }

    public function customers(){
        $this->includeUserOnJS();
    	return view('shop_owner.customers');
    }

    public function todo(){
        $this->includeUserOnJS();
        return view('shop_owner.todo');
    }

    public function workers(){
        $this->includeUserOnJS();
        return view('shop_owner.workers');
    }

    public function workersTodo(){
        $this->includeUserOnJS();
        return view('shop_owner.workers_todo');
    }

    public function setShopSession(Shop $shop){
      session()->put("selected_shop", $shop);
      $input = Input::all();
      return redirect(base64_decode($input['redirect']));
        
    }
    /**
     * This function is called when a target user confirms his subscribption to the Shop
     *
     */
    public function subscribe(Shop $shop){
        if( !auth()->check() ){
            session()->put('url.intended', url('shops/'.$shop->id.'/subscribe'));
            return redirect('login');
        }

        $user = auth()->user();

        // prevents duplicate by clicking the Subscribe button from email multiple times
        if( $shop->users()->find($user->id) != null )
            return redirect('shop')->withFlash_message([
                    'msg' => 'You have already subscribed to '.$shop->name,
                    'type' => 'danger',
                    'is_important' => true
                ]);
        if( $shop->users()->save($user) )
            return redirect('shop')->withFlash_message([
                    'msg' => 'You are now subscribed to '.$shop->name,
                    'type' => 'success'
                ]);

        return ['success' => 0];
    }

    public function generatePassword(Shop $shop, User $user){
        // verify if requested user is attached to the current shop
        if( $shop->users()->find($user->id) != null ){
            try {
                $password = str_random(8);
                $user->password = bcrypt($password);
                $user->save();
                $user->raw_password = $password;
                $mail = new PasswordReset($user);
                Mail::to($user->email)->send($mail);

                return ['success' => 1];
            } catch (\Exception $e) {
                return ['success' => 0];
            }
        }

        return ['success' => 0, 'msg' => 'The specified user is not a customer of this shop.'];
    }

    public function invite(Shop $shop, ShopInvitationRequest $request, $role = "customer"){
        try {
            $user_classification = $role == 'customer' ? 'subscriber' : 'worker';

            $input = Input::all();

            $user = User::where('email', '=', $input['email'])->first();
            $current_user = User::where('api_token', '=', $input['api_token'])->first();
            
            $password = str_random(8);

            if( $user == null ){
                $user = new User;
                $user->first_name = $input['name'];
                $user->last_name = "";
                $user->password = bcrypt($password);
                $user->email = $input['email'];
                $user->api_token = str_random(60);
                $user->role = $role;
                $user->save();
                $user->plain_password = $password;
            }else{
                // prevents duplicate of subscribers
                if( $shop->users()->find($user->id) != null  )
                    return ['success' => 0, 'msg' => 'This user is already a '.$user_classification.' of '.$shop->name];

                // prevents owner to invite himself
                if( auth()->user()->email == $input['email'] )
                    return [
                        'success' => 0, 
                        'msg' => "Sorry, you can't invite yourself to be a $user_classification of your own Shop."
                    ];

            }

            if( $role == 'customer' ){
                $mail = new ShopInvitation($shop, $user);
                $msg = $user->email." has been invited to subscribe to ".$shop->name;
            }else{
                $mail = new ShopWorkerInvitation($shop, $user, $current_user);
                $msg = $user->email." has been invited to be a part of ".$shop->name.' family.';
            }

            Mail::to($input['email'])->send($mail);

            return ['success' => 1, 'msg' => $msg];

        } catch (\Exception $e) {
            Log::error($e);
            return ['success' => 0, 'msg' => "An error occured while processing your request.", 'errors' => $e];
        }
    }

    public function inviteWorker(Shop $shop, ShopInvitationRequest $request){
        return $this->invite($shop, $request, "worker");
    }

    public function loginAsSomeone(User $user, $shopId = false, Request $request){
        // dd($user->id); 
        // dd(auth()->user()->id);   
        // dd(session()->has('selected_shop'));  

        if( $shopId != false ){
            $shop = Shop::findOrFail($shopId);
            session()->put('selected_shop', $shop);
        }

        if( session()->has('selected_shop') ){
            $shop = session()->get('selected_shop');

            $auth_user_id = auth()->user()->id;

            // validate if user actually own this shop
            // and make sure the loggedin user is not also the specified user
            if( ($shop->owner()->first()->id == $auth_user_id && $auth_user_id != $user->id) || auth()->user()->isAdmin() ){
                $request->session()->flush();
                $request->session()->regenerate();

                auth()->loginUsingId($user->id);

                // the shopowner who logged in as customer/client
                session()->put('loggedin_as_someone', ['id' => $auth_user_id, 'url' => url()->previous()]);
                return redirect('shop');
            }
        }

        return redirect()->back();
    }

    public function loginBack(Request $request){
        if( $request->session()->has('loggedin_as_someone') ){
            $real_auth = session()->get('loggedin_as_someone');

            $request->session()->flush();
            $request->session()->regenerate();

            auth()->loginUsingId($real_auth['id']);

            return redirect($real_auth['url'])->withFlash_message([
                    'type' => 'info',
                    'msg' => "Welcome back ".ucfirst(auth()->user()->first_name)."!"
                ]);
        }

        return redirect()->back();
    }

    public function toggleNewsletterSubscription(Shop $shop, User $user){
        $val = Input::get('newsletter_subscription');
        $timestamp = $user->shops()->find($shop->id)->pivot->created_at; // gets id of pivot table for shops and users
        $res = $user->shops()->newPivotStatementForId($shop->id)->where('created_at', '=', $timestamp)
            ->update([ 'newsletter_subscribed' => $val ]);
            
        $action = $val ? "subscribed" : "unsubscribed";

        if( $res ){
            $msg = ucfirst($user->first_name)." is now {$action} to {$shop->name} newsletter.";
        }else{
            $msg = "No changes have been made.";
        }

        return ['success' => $res ? 1 : 0, 'msg' => $msg];
    }

    public function spots(Salespot $id){

        $this->includeUserOnJS();
        return view('shop_owner.spots');
    }
}
