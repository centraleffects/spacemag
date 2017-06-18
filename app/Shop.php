<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes;

    protected $guarded = [ 'id' ];
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];

    /**
     * returns the Owner of this Shop
     */
    public function owner(){
    	return $this->belongsTo('App\User', 'user_id');
    }  

    /**
     * returns the list of customers/clients in this Shop
     */
    public function users(){
        return $this->belongsToMany('App\User')
                ->withPivot('user_id', 'shop_id', 'newsletter_subscribed')
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
    	return $this->hasMany('App\Article');
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

    public function salespotBookings(){
        return $this->hasManyThrough('App\SalespotBooking', 'App\Salespot');
    }

    /**
     * TodoTasks for this Shop
     */
    public function todoTasks(){
        return $this->hasManyThrough('App\TodoTask', 'App\Salespot');
    }

    public function tasks(){
        return $this->hasMany('App\TodoTask');
    }

    // public function newsletterSubscriptions(){
    //     return $this->hasMany('App\ShopNewsletterSubscription', 'shop_id');
    // }
}
