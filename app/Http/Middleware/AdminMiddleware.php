<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have a column 'is_admin' in the 'users' table
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect('/');  // Redirect if not admin
        }

        return $next($request);
    }
}

