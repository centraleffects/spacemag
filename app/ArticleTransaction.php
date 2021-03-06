<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTransaction extends Model
{
    protected $guarded = [ 'id' ];

    public function article(){
    	return $this->belongsTo('App\Article');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }
}
