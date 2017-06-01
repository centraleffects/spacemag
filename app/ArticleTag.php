<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_tag";

    public function articles(){
    	return $this->belongsTo('App\Article', 'article_id');
    }

    public function tag(){
    	return $this->belongsTo('App\Tag');
    }
}
