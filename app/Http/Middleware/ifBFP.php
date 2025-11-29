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
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $role = Auth::user()->role;

        switch ($role) {
            case 'bfp':
            case 'bfp_inspector':
            case 'bfp_inspector_I':
            case 'bfp_inspector_II':
            case 'bfp_inspector_III':
            case 'bfp_inspector_IV':
            case 'bfp_inspector_V':
                return $next($request);

            default:
                return response()->json(['error' => 'Unauthorized'], 403);
        }
    }
}
