<?php

namespace App\Http\Middleware;

use Closure;

class sessionControl
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
        
        if(!session()->has('sessionKey')){
            return redirect('/');
            
        } else {
            return $next($request);
        }

    }
}
