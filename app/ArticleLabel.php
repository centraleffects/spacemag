<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleLabel extends Model
{
    protected $guarded = [ 'id' ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function article(){
    	return $this->belongsTo('App\Article');
    }

    public function salespot(){
    	return $this->belongsTo('App\Salespot');
    }

    public function mediaType(){
    	return $this->belongsTo('App\MediaType');
    }
}
