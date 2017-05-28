<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    
    use SoftDeletes;

    protected $guarded = [ 'id' ];
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];
    protected $table = "tags";

    // returns the user who created this tag
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
	