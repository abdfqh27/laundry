<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('error', 'Unauthorized access');
    }
}