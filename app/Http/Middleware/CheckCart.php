<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;

class CheckCart
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
        if(!Cart::quantity()){
            return redirect()->back();
        }
        
        return $next($request);
    }
}