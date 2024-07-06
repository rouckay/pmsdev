<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized FUcked'], 401);
        }

        // Check if the authenticated user has the required role or permission
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json(['error' => 'Unauthorized'], 403);
    }
}
