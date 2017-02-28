<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotCategory extends Model
{
    protected $guarded = [ 'id' ];

    public function type(){
    	return $this->belongsTo('App\SalespotCategoryType');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }
    
    public function author(){
    	return $this->belongsTo('App\User');
    }
}
