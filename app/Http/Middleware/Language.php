<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        $locales = ['en', 'ar'];

        if($request->has('lang') && in_array($request->lang, $locales)){
            \App::setLocale($request->lang);
        }

        return $next($request);
    }
}
