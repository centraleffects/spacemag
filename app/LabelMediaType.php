<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabelMediaType extends Model
{
    protected $guarded = [ 'id' ];


    public function articleLabels(){
    	return $this->hasMany('App\ArticleLabel');
    }
}
