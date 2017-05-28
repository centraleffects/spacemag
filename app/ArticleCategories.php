<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCategories extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_categories";

    public function articles(){
    	return $this->belongsToMany('App\Article', 'article_id');
    }

    // returns the user who created this tag
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function category(){
    	return $this->belongsTo('App\SalespotCategoryType', 'category_id');
    }
}
