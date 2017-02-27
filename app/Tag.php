<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "article_tags";

    public function articles(){
    	return $this->belongsToMany('App\Article');
    }

    // returns the user who created this tag
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
