<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
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
        if ( !isset($_COOKIE['locale']) ) {
            $_COOKIE['locale'] = app()->getLocale();
        }

        app()->setLocale( $_COOKIE['locale'] );

        return $next($request);
    }
}