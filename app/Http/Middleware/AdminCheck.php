<?php

namespace App\Http\Middleware;

use Closure;

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
        if (empty(session('userId'))) {
            return response()->json('You are not logged in'); 
        }

        $userId = session('userId');
        if ($userId != 2)
            return response()->json('You are not an admin'); 

        return $next($request);
        
    }
}
