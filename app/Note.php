<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [ 'id' ];

    public function author(){
    	return $this->belongsTo('App\User');
    }
}
