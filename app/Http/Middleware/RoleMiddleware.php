<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/samad')->with('error', 'You must be logged in to access this page.');
        }

        $user = Auth::user();

        // Handle admin role - both admin and super_admin can access admin routes
        if ($role === 'admin') {
            if (!$user->hasAdminPrivileges()) {
                abort(403, 'Unauthorized. Admin access required.');
            }
        } 
        // Handle super admin role - only super_admin can access
        elseif ($role === 'super_admin') {
            if (!$user->isSuperAdmin()) {
                abort(403, 'Unauthorized. Super Admin access required.');
            }
        }
        // Handle other specific roles
        else {
            if (!$user->hasRole($role)) {
                abort(403, 'Unauthorized. You do not have permission to access this page.');
            }
        }

        return $next($request);
    }
}
