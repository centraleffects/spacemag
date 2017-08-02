<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use Mail;

use App\Shop;
use App\User;

use App\Mail\PasswordReset;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;
use App\Mail\ShopWorkerInvitation;
use App\Helpers\Helper;


class ShopOwnerController extends Controller{

	
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

}