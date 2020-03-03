<?php

namespace App\Http\Middleware;

use Closure;

class CheckPrivate
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
        
        if(is_null(Auth()->user()))
        { 
            return redirect('login');
        }
        else if(Auth()->user()->id != 'admin')
        {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
