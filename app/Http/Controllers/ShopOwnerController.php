<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use JavaScript;
use Mail;

use App\Mail\PasswordReset;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;
use App\Mail\ShopWorkerInvitation;
use App\Helpers\Helper;

use App\Shop;
use App\User;
use App\Salespot;

class ShopOwnerController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            
            if( auth()->check() && (auth()->user()->isOwner() or auth()->user()->isWorker()) ){
                $user = auth()->user();

                if( auth()->user()->isOwner() ){
                    $shops = $user->ownedShops()->get();

                    // $shop = auth()->user()->ownedShops()->with('todoTasks')
                    //             ->with('todoTasks.owner')->first();
                   
                }else{
                    $shops = $user->shops()->get();
                    // $shop = $user->shops()->first();
                }

                $shop = Helper::getShopWithTasks(auth()->user(), true);

                session()->put('shops', $shops);

                if( !session()->has("selected_shop") ){
                    
                    session()->put("selected_shop", $shop);
                }

                // $shop = session()->get('selected_shop');
                

                JavaScript::put([
                    'user' => $user,
                    'selectedShop' => $shop
                ]);
            }

            return $next($request);
            
        });
    }

    public function index(){

    	return view('shop_owner.dashboard');
    }

    public function articles(){
        $articles = auth()->user()->articles()->get();
        // $tags = 

        JavaScript::put([
            'articles' => $articles
        ]);

        
    	return view('shop_owner.articles')->withArticles($articles);
    }

    public function customers(){
        
    	return view('shop_owner.customers');
    }

    public function todo(){
        
        return view('shop_owner.todo');
    }

    public function workers(){
        
        return view('shop_owner.workers');
    }

    public function workersTodo(){
        
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
                    'msg' => __("messages.already_subscribed_to_shop", ["shop_name" => $shop->name]),
                    'type' => 'danger',
                    'is_important' => true
                ]);
        if( $shop->users()->save($user) )
            return redirect('shop')->withFlash_message([
                    'msg' => __('messages.shop_subscription_success', ["shop_name" => $shop->name]),
                    'type' => 'success',
                    'is_important' => false
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

        return ['success' => 0, 'msg' => __('errors.not_a_customer_of_shop')];
    }

    public function invite(Shop $shop, ShopInvitationRequest $request, $role = "customer"){
        try {
            $user_classification = $role == 'customer' ? 'subscriber' : 'worker';

            $input = Input::all();

            $user = User::where('email', '=', strtolower($input['email']))->first();
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
                    return [
                        'success' => 0, 
                        'msg' => __(
                                "errors.user_associated_with_shop_already", 
                                ["user_classification" => $user_classification, "shop_name" => $shop->name]
                            )
                        ];


                // prevents owner to invite himself
                if( auth()->user()->email == $input['email'] )
                    return [
                        'success' => 0, 
                        'msg' => __("errors.self_invitation_denied", 
                                    ["user_classification" => $user_classification])
                    ];

            }

            if( $role == 'customer' ){
                $mail = new ShopInvitation($shop, $user);
                $msg = __("messages.shop_invitation_success", 
                            ["email" => $user->email, "shop_name" => $shop->name]);
            }else{
                $mail = new ShopWorkerInvitation($shop, $user, $current_user);
                $msg = __("messages.shopworker_invitation_success", 
                            ["email" => $user->email, "shop_name" => $shop->name]);
            }

            Mail::to($input['email'])->send($mail);

            return ['success' => 1, 'msg' => $msg];

        } catch (\Exception $e) {
            Log::error($e);
            return ['success' => 0, 'msg' => __("errors.error_while_processing"), 'errors' => $e];
        }
    }

    public function inviteWorker(Shop $shop, ShopInvitationRequest $request){
        return $this->invite($shop, $request, "worker");
    }

    public function loginAsSomeone(User $user, $shopId = false, Request $request){

        if( $shopId != false ){
            $shop = Shop::findOrFail($shopId);
            session()->put('selected_shop', $shop);
        }

        if( session()->has('selected_shop') ){
            $shop = session()->get('selected_shop');

            $auth_user_id = auth()->user()->id;
            // preserve the current localization
            $currentLocale = \App::getLocale();

            // validate if user actually own this shop
            // and make sure the loggedin user is not also the specified user
            if( ($shop->owner()->first()->id == $auth_user_id && $auth_user_id != $user->id) || auth()->user()->isAdmin() ){
                $request->session()->flush();
                $request->session()->regenerate();

                auth()->loginUsingId($user->id);

                session()->put('applocale', $currentLocale); 

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

             // preserve the current localization
            $currentLocale = \App::getLocale();

            $request->session()->flush();
            $request->session()->regenerate();

            auth()->loginUsingId($real_auth['id']);
            
            session()->put('applocale', $currentLocale); 

            return redirect($real_auth['url'])->withFlash_message([
                    'type' => 'info',
                    'msg' => __('messages.welcome_back', ['name' => ucfirst(auth()->user()->first_name)]),
                    'important' => false
                ]);
        }

        return redirect()->back();
    }

    public function toggleNewsletterSubscription(Shop $shop, User $user){
        $newsletter_subscription = Input::get('newsletter_subscription');
        $val = $newsletter_subscription == 'true' ? 1 : 0;

        $shop = $user->shops()->find($shop->id);
        $shop->pivot->newsletter_subscribed = $val;
        $res = $shop->pivot->update();
            
        $action = $val == 1 ? "subscribed" : "unsubscribed";

        if( $res ){
            $msg = __('messages.newsletter_toggle_status', 
                        ['user' => ucfirst($user->first_name), 'action' => $action, 'shop' => $shop->name]
                    );
        }else{
            $msg = __('messages.no_changes_saved');
        }

        return ['success' => $res ? 1 : 0, 'msg' => $msg];
    }

    public function spots(Salespot $id){

        
        return view('shop_owner.spots');
    }
}
