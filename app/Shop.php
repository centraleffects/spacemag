<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "shops";

    // returns the Owner of this Shop
    public function owner(){
    	return $this->belongsTo('App\User');
    }  

    public function users(){
    	return $this->hasMany('App\User')
    				->withPivot('user_id', 'shop_id')
    				->withTimestamps();
    }

    public function coupons(){
    	return $this->hasMany('App\ShopCoupon');
    }


   	// returns the articles within this Shop
    public function articles(){
    	return $this->hasMany('App\Article')
    				->withPivot('article_id', 'shop_id')
    				->withTimestamps();
    }
}
