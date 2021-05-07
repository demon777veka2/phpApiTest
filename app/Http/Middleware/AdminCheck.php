<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        //Auth::user()->id;
        if (empty($userId = Auth::user()->id)) {
            return response()->json('You are not logged in'); 
        }

        if ($userId == 2)
            return $next($request);


         return response()->json('You are not an admin'); 

        
        
    }
}
