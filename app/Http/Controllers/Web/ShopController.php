<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Shop;

class ShopController extends Controller{

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

        if( $user->isAdmin() ){
            return redirect('shop')->withFlash_message([
                'msg' => __("messages.admin_cannot_subscribe", ["shop_name" => $shop->name]),
                'type' => 'danger',
                'is_important' => true
            ]);
        }

        //  prevents duplicate when the user role is an owner
        if( $user->isOwner() && $user->ownedShops()->find($shop->id) !== null )
            return redirect('shop')->withFlash_message([
                    'msg' => __("messages.already_owned_this_shop", ["shop_name" => $shop->name]),
                    'type' => 'danger',
                    'is_important' => true
                ]);

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
}