<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleSpot extends Model
{
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];

    public function article(){
    	return $this->belongsTo('App\Article', 'article_id');
    }
}
