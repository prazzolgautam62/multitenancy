<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MainAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        if( is_null(auth()->user()->tenant_id)  == ($type == 'main') )
            ; else
            return response()->json(['status' => false, 'message' => 'unauthorized action!']);
        return $next($request);
    }
}
