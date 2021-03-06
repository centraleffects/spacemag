<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotBooking extends Model
{
    protected $guarded = [ "id" ];

    /**
     * The owner of this booking
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }
}
