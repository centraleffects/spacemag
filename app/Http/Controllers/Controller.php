<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
        	if( auth()->check() ){
        		$user = auth()->user();
        	
        		if( auth()->guard('api')->user() ){
			        $user = auth()->guard('api')->user();
        		}

		        if($user && $user->lang != "" ){
		            app()->setLocale($user->lang);
		        }
		    }

	        return $next($request);
	    });
    }
}
