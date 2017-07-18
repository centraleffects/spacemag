<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $guarded = [ 'id' ];
    protected $table = "articles";


    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tags(){
    	return $this->hasmany('App\ArticleTag');
    }

    public function categories(){
        return $this->hasmany('App\ArticleCategory');
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
        return $this->hasOne('App\ArticleLabel');
    }

    public function salespots(){
        return $this->hasMany('App\ArticleSpot')->withPivot('article_id');
    }

    
}