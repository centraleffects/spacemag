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

    /**
     * Returns list of shops with this article
     */
    public function shops(){
    	return $this->belongsToMany('App\Shop');
    }

    public function transactions(){
        return $this->hasMany('App\ArticleTransaction');
    }

    public function labels(){
        return $this->hasMany('App\ArticleLabel');
    }

    
}