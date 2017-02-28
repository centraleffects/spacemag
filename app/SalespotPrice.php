<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotPrice extends Model
{
    protected $guarded = [ 'id' ];

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }
}
