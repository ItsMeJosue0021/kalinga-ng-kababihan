<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/login') || $request->is('api/register')) {
            return $next($request);
        }

        if (!$request->user()) {
            return response()->json(['message' => 'unauthorized'], 401);
        }

        return $next($request);
    }
}
