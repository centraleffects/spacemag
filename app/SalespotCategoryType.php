<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotCategoryType extends Model
{
    protected $guarded = [ 'id' ];

    public function categories(){
    	return $this->hasMany('App\SalespotCategory');
    }
}
