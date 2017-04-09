<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use JavaScript;
use Mail;

use App\Shop;
use App\User;
use App\Mail\PasswordReset;
use App\Http\Requests\ShopInvitationRequest;
use App\Mail\ShopInvitation;

class ShopOwnerController extends Controller
{

    public function includeUserOnJS()
    {
        if( !session()->has("selected_shop") && auth()->check() ){
            session()->put("selected_shop", auth()->user()->shops()->first());
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

    public function addWorker(){
        
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

    public function invite(Shop $shop, ShopInvitationRequest $request){
        try {
            $input = Input::all();

            $user = User::where('email', '=', $input['email'])->first();
            // dd($user);
            $password = str_random(8);

            if( $user == null ){
                $user = new User;
                $user->first_name = $input['name'];
                $user->last_name = "";
                $user->password = bcrypt($password);
                $user->email = $input['email'];
                $user->api_token = str_random(60);
                $user->role = 'customer';
                $user->save();
                $user->plain_password = $password;
            }else{
                // prevents duplicate of subscribers
                if( $shop->users()->find($user->id) != null  )
                    return ['success' => 0, 'msg' => 'This user is already a subscriber of '.$shop->name];

                // prevents owner to invite himself
                if( auth()->user()->email == $input['email'] )
                    return [
                        'success' => 0, 
                        'msg' => "Sorry, you can't invite yourself to be a subscriber of your own Shop."
                    ];

            }

            $mail = new ShopInvitation($shop, $user);

            Mail::to($input['email'])->send($mail);

            return ['success' => 1];

        } catch (\Exception $e) {
            dd($e);
            return ['success' => 0];
        }
    }
}
