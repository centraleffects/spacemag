<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_tags";

    public function articles(){
    	return $this->hasMany('App\Article');
    }
}
