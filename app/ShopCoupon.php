<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCoupon extends Model
{
    protected $guarded = [ "id" ];

    public function shop(){
    	return $this->belongsTo('App\Shop');
    }

    public function user(){
    	return $this->belongsTo('App\User')->withPivot('user_id', 'shop_coupon_id');
    }
}
