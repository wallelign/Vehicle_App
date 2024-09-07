<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Get the user's role
        $userRole = auth()->user()->role;

        // Check if the user's role is in the allowed roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // If not, return a 403 response
        return response()->json(['error' => 'Forbidden'], 403);
    }
}

