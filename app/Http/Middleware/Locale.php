<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        $language = Session::get('website_language', config('app.locale'));
        // echo  config('app.locale');
        // dd($language);
        // echo \Session::get('website_language');
        \App::setLocale($language);
        // echo config('app.locale');
        // die;
        // config(['app.locale' => $language]);
        return $next($request);
    }
}
