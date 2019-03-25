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
            $availableLangs = ['us', 'en-US', 'nl', 'de'];
            $userLangs = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($availableLangs as $lang) {
                if(in_array($lang, $userLangs)) {
                    if ( $lang === 'en-US' ) {
                        $lang = 'us';
                    }
                    app()->setLocale($lang);
                    break;
                }
            }

            $_COOKIE['locale'] = app()->getLocale();
            setcookie('locale', app()->getLocale(), intval(time() + (86400 * 30 * 400) ), "/");
        }

        app()->setLocale( $_COOKIE['locale'] );

        return $next($request);
    }
}