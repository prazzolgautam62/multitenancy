<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {   
        if(!auth()->user()->hasPermission($permission))
            return response()->json(['status' => false, 'message' => 'Unauthorized! user lacks permission']);
        return $next($request);
    }
}
