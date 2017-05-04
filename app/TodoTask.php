<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoTask extends Model
{
    protected $guarded = [ 'id' ];

    // assignee of this task
    public function owner(){
    	return $this->belongsTo('App\User', 'worker_user_id');
    }

    // creator of this taske
    public function author(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }

    // if salespot is not defined, this task will be associated to the shop directly
    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function shopServicesBooking(){
    	return $this->belongsTo('App\ShopServicesBooking');
    }

    public function serviceType(){
    	return $this->belongsTo('App\ServiceType');
    }
}
