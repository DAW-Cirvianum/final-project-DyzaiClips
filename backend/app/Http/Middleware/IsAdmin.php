<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * IsAdmin Middleware
 *
 * Ensures that the authenticated user has admin role.
 */
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized. Admin access required.'
            ], 403);
        }

        return $next($request);
    }
}


