<?php

namespace App\Http\Middleware;

use Closure;
Use Carbon;
use Session;
use App;

class Localization
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
        if ( Session::has('locale')) {
            App::setLocale(Session::get('locale'));
 
            // You also can set the Carbon locale
            Carbon::setLocale(Session::get('locale'));
        }
 
        return $next($request);
    }
}
