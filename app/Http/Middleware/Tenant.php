<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    ///only use this middleware after auth middleware
    public function handle($request, Closure $next)
    {
        $authUser = auth()->user();

        try {
            $authUser->tenant->connect();
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Internal server error!']);
        }

        return $next($request);
    }
}
