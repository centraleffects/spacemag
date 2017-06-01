<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_category";

    public function articles(){
    	return $this->belongsToMany('App\Article', 'article_id');
    }


    public function category(){
    	return $this->belongsTo('App\SalespotCategoryType', 'category_id');
    }
}
