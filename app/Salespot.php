<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salespot extends Model
{
    protected $guarded = [ "id" ];

    public function shop(){
    	return $this->belongsTo('App\Shop');
    }

    public function bookings(){
    	return $this->hasMany('App\SalespotBooking');
    }

    public function articleTransactions(){
    	return $this->hasMany('App\ArticleTransactions');
    }

    public function categories(){
        return $this->hasMany('App\SalespotCategory');
    }

    public function articleLabels(){
        return $this->hasMany('App\ArticleLabel');
    }

    public function todoTasks(){
        return $this->hasMany('App\TodoTask');
    }

    public function prices(){
        return $this->hasOne('App\SalespotPrice');
    }
}
