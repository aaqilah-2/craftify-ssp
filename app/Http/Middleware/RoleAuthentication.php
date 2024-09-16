<?php
namespace App\Http\Middleware;

use Closure;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAuthentication
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // If user is not authenticated, deny access
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        // Check if the authenticated user's role matches any of the provided roles
        foreach ($roles as $role) {
            if ($request->user()->role === (int) $role) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Access denied.'], 403);
    }
}
