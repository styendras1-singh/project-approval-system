<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Forbidden - Admin only access'
                ], 403);
            }

            abort(403, 'Only admin can access this page.');
        }

        return $next($request);
    }
}