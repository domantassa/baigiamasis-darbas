<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        else if(Auth()->user()->position != 'admin')
        {
            return redirect('dashboard');
        }
        return $next($request);
    }
}
