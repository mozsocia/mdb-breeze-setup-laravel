<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $prefix = $guard ? $guard .".": "";

        // $guard = $guard ?: 'web123';

        if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        

        return redirect(route( $prefix ."login"));
    }
}
