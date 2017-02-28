<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = [ "id" ];

    public function bookings(){
    	return $this->hasMany('App\ShopServicesBooking');
    }

    public function todoTask(){
    	return $this->hasMany('App\TodoTask');
    }
}
