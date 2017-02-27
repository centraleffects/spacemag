<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "shops";

    public function users(){
    	return $this->belongsTo('App\User');
    }  

    public function coupons(){
    	return $this->hasMany('App\ShopCoupon');
    }
}
