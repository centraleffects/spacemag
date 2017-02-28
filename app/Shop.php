<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "shops";

    /**
     * returns the Owner of this Shop
     */
    public function owner(){
    	return $this->belongsTo('App\User');
    }  

    /**
     * returns the list of Workers in this Shop
     */
    public function users(){
    	return $this->hasMany('App\User')
    				->withPivot('user_id', 'shop_id')
    				->withTimestamps();
    }

    /**
     * returns the coupons for this Shop
     */
    public function coupons(){
    	return $this->hasMany('App\ShopCoupon');
    }


    /**
     * returns the articles within this Shop
     */
    public function articles(){
    	return $this->hasMany('App\Article')
    				->withPivot('article_id', 'shop_id')
    				->withTimestamps();
    }

    /**
     * returns the SaleSpots on this Shop
     */
    public function salespots(){
    	return $this->hasMany('App\Salespot');
    }


    /**
     * @since Laravel 5.4
     * use of hasManyThrough
     * returns list of article transactions within this Shop
     */
    public function articleTransactions(){
    	return $this->hasManyThrough('App\ArticleTransaction', 'App\Salespot');
    }

    /**
     * TodoTasks for this Shop
     */
    public function todoTasks(){
        return $this->hasManyThrough('App\TodoTask', 'App\Salespot');
    }
}
