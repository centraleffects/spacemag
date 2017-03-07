<?php

namespace App\Http\Middleware;

use Closure;

class ClientAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        if(auth()->check() && 
            ( !auth()->user()->isClient() && !auth()->user()->isCustomer() ) 
        ) 
        {
            return redirect('home');
        }

       
        return $next($request);
    }
}
