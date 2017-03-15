<?php

namespace App\Http\Middleware;

use Closure;

class ShopWorkerAuthenticated
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
        if( !auth()->check() or !$request->user()->isWorker() ){
            return redirect('home');
        }
        
        return $next($request);
    }
}
