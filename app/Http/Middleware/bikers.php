<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class bikers
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type != \App\Models\User::TYPE['biker']) {
            $response = [
                'success' => false,
                'message' => "Access denied",
            ];
            return response()->json($response, 403);
        }
        return $next($request);
    }
}
