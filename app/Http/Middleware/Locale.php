<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Closure;

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
        $locale=$request->session()->get('locale');
        App::setLocale($locale);
        //dd($locale);
        /*
        if(!$locale)
        {
         Session::put('locale','en');
         App::setLocale('lt');
        }
        else if(App::getLocale()=='en')
        {
        App::setLocale('lt');
        }
        else if(App::getLocale()=='lt'){
            App::setLocale('en');
        }
*/
        return $next($request);
    }
}
