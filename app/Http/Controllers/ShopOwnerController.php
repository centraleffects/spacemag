<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;

use App\Shop;

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
}
