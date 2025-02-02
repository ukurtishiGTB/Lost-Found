<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            abort(403, 'Administrators cannot access this section.');
        }

        return $next($request);
    }
}