<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next,$num='0')
    {
        
        if (!Auth::check()) {
            return redirect('login');
        }else if($num == Auth::user()->roles){
            return $next($request);
        } else{
            return redirect('/');
        }
    }
}