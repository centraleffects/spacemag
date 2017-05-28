<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticlePrice extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_prices";
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];
    
    public function article(){
    	return $this->belongsTo('App\Article');
    }
}
