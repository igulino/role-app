<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Providers\RouteServiceProvider;

class RoleVerification  {

    public function handle(Request $request, Closure $next) {
        $user = $request->user();

        if (Gate::forUser($user)->allows('accessUserDashboard', User::class)) {
            Log::info("this is user");
            if ($request->is(ltrim(RouteServiceProvider::HOMEadmin, '/'))) {
                return redirect(RouteServiceProvider::HOMEuser);
            }

            return $next($request);
           
        }

        if (Gate::forUser($user)->allows('accessAdminDashboard', User::class)) {
            Log::info("ITS A ADMIN");
            if ($request->is(ltrim(RouteServiceProvider::HOMEuser, '/'))) {
                return redirect(RouteServiceProvider::HOMEadmin);
            }
            
            return $next($request);
        }
        

        abort(403);
    }
    
}
