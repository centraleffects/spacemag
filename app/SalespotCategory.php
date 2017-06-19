<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotCategory extends Model
{
    protected $guarded = [ 'id' ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function type(){
    	return $this->belongsTo('App\SalespotCategoryType', 'category_type_id');
    }

    public function salespot(){
        return $this->belongsToMany('App\Salespot');
    }
    
    public function author(){
    	return $this->belongsTo('App\User');
    }
}
