<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();
        
        // If specific roles are provided as parameters
        if (!empty($roles)) {
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
            
            // If user doesn't have required role
            abort(403, 'Unauthorized access.');
        }
        
        // If no roles specified, just check if user is admin or editor
        if ($user->role === 'admin' || $user->role === 'editor') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}