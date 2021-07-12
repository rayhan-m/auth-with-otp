<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifiedUserMiddleware
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
        if (Auth::check() && Auth::user()->role->id== 2 && Auth::user()->verification_status == 1 && Auth::user()->email_verified_at != null ) {
            return $next($request);
        } elseif(Auth::check() && Auth::user()->role->id== 1) {
            return $next($request);
        }else {
            return redirect()->route('verification');
        }
    }
}