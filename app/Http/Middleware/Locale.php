<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;

class Locale
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
        if (Session::has('website_language')) {
            $language = Session::get('website_language');
        } else {
            $language = config('app.locale');
        }

        App::setLocale($language);

        return $next($request);
    }
}
