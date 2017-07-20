<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SalespotCategoryType extends Model
{
    protected $guarded = [ 'id' ];
    protected $table = "salespot_category_types";

    public function categories(){
    	return $this->hasMany('App\SalespotCategory');
    }

    public function articles(){
    	return $this->belongsToMany('App\Article', 'article_category')
    		->withPivot('article_id', 'salespot_category_type_id')
    		->withTimestamps();
    }
}
