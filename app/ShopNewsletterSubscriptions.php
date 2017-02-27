<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopNewsletterSubscriptions extends Model
{
    protected $guarded = [ "id" ];

    // gets the list of subscribers for this newsletter
    public function users(){
    	return $this->hasMany('App\User');
    }

    public function shop(){
    	return $this->belongsTo('App\Shop');
    }
}
