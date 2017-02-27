<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlePrice extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_prices";

    public function article(){
    	return $this->belongsTo('App\Article');
    }
}
