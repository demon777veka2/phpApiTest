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
        if (empty($role = Auth::user()->role)) {
            return response()->json('You are not logged in');
        }

        if ($role == 'admin')
            return $next($request);

        return response()->json('You are not an admin');
    }
}
