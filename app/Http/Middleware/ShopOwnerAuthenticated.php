<?php

namespace App\Http\Middleware;

use Closure;

class ShopOwnerAuthenticated
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
        if( !auth()->check() or (!$request->user()->isOwner() and !$request->user()->isWorker()) ) 
        {
            return redirect('home');   
        }

        return $next($request);
    }
}
