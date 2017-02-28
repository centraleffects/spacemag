<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $guarded = [ 'id' ];

    public function author(){
    	return $this->belongsTo('App\User', 'worker_user_id');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }

    public function shopServicesBooking(){
    	return $this->belongsTo('App\ShopServicesBooking');
    }

    public function serviceType(){
    	return $this->belongsTo('App\ServiceType');
    }
}
