<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLayoutMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Skip Breeze layout for admin routes
        if ($request->is('admin/*')) {
            config(['breeze.layout' => false]);
        }
        
        return $next($request);
    }
}