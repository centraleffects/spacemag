<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "articles";

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tags(){
    	return $this->hasMany('App\Tag');
    }

    public function prices(){
    	return $this->hasMany('App\Prices');
    }

    public function shops(){
    	return $this->belongsToMany('App\Shop')
    				->withPivot('article_id', 'shop_id')
    				->withTimestamps();
    }
}