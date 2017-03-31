<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [ 'id' ];
    protected $dates = [ 'deleted_at' ];   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * returns the Shops that this user owned
     */
    public function shops(){
        return $this->hasMany('App\Shop');
        // return $this->hasMany('App\Shop')
        //     ->withPivot('user');
        // return $this->belongsToMany('App\Shop')->withTimestamps();
    }


    /**
     * returns the articles that this user has created.
     */
    public function articles(){
        return $this->hasMany('App\Article');
    }

    /**
     * Billing details of this user
     */
    public function billingDetails(){
        return $this->hasMany('App\BillingDetail');
    }

    /**
     * The Shop services bookings made by this user
     */
    public function shopServicesBookings(){
        return $this->hasMany('App\ShopServicesBooking');
    }

    /**
     * Returns the Salespot Categories that the user has authored
     */
    public function salespotCategories(){
        return $this->hasMany('App\SalespotCategory');
    }

    /**
     * The SaleSpots bookings made by this user
     */
    public function salespotBookings(){
        return $this->hasMany('App\SalespotBooking');
    }


    /**
     * The notes that this user has authored
     */
    public function notes(){
        return $this->hasMany('App\Note');
    }

    /**
     * the article labels that this user authored
     */
    public function articleLabels(){
        return $this->hasMany('App\ArticleLabel');
    }

    public function todoTasks(){
        return $this->hasMany('App\TodoTask', 'worker_user_id');
    }


    /**
     * determines if a user is admin
     * possible user types: admin, owner, worker, client, customer
     */
    public function isAdmin(){
        return $this->role == 'admin' ? true : false;
    }

    /**
     * determines if user is a shop owner
     */
    public function isOwner(){
        return $this->role == 'owner' ? true : false;
    }

    /**
     * determines if user is a shop worker
     */
    public function isWorker(){
        return $this->role == 'worker' ? true : false;
    }

    /**
     * if a user already had a bookings, his account will be
     * upgraded to 'client'
     */
    public function isClient(){
        return $this->role == 'client' ? true : false;
    }

    /**
     * when a normal user doesn't have any bookings yet
     * then he's considered to be just a customer
     */
    public function isCustomer(){
        return $this->role == 'customer' ? true : false;
    }


}
