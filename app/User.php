<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [ 'id' ];
    protected $table = "users";   

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
    }

    /**
     * returns the articles that this user has created.
     */
    public function articles(){
        return $this->hasMany('App\Article');
    }

    /**
     * determines if a user is admin
     * possible user types: admin, owner, worker, client, customer
     */
    public function isAdmin(){
        return $this->type == 'admin' ? true : false;
    }

    /**
     * determines if user is a shop owner
     */
    public function isOwner(){
        return $this->type == 'owner' ? true : false;
    }

    /**
     * determines if user is a shop worker
     */
    public function isWorker(){
        return $this->type == 'worker' ? true : false;
    }

    /**
     * if a user already had a bookings, his account will be
     * upgraded to 'client'
     */
    public function isClient(){
        return $this->type == 'client' ? true : false;
    }

    /**
     * when a normal user doesn't have any bookings yet
     * then he's considered to be just a customer
     */
    public function isCustomer(){
        return $this->type == 'customer' ? true : false;
    }
}
