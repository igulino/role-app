<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        Gate::authorize('UpdateAdmin', $request->user());

        return $next($request);
    }
}
