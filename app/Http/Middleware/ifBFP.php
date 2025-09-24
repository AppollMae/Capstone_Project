<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ifBFP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role === 'bfp'){
            return $next($request);
        }

        if(Auth::check() && Auth::user()->role === 'bfp_inspector') {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
