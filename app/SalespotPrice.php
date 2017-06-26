<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalespotPrice extends Model
{
    
    use SoftDeletes;
    
    protected $guarded = [ 'id' ];

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }
}
