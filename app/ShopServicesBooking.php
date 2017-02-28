<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopServicesBooking extends Model
{
    protected $guarded = [ "id" ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }

    public function serviceType(){
    	return $this->belongsTo('App\ServiceType');
    }

    public function todoTask(){
        return $this->hasMany('App\TodoTask');
    }
}
