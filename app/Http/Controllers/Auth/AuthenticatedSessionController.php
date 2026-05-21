<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Services\LoginService;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    
    

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
     
        $request->ensureIsNotRateLimited();
        $LoginService = new LoginService;
        $LoginService->authenticate($request);

        $request->session()->regenerate();

        $user = $request->user();
        Log::info("userrole: " . $user->role);

        if (Gate::forUser($user)->allows('accessUserDashboard', User::class)) {
            Log::info("this is user");
            return redirect()->intended(RouteServiceProvider::HOMEuser);
        }

        if (Gate::forUser($user)->allows('accessAdminDashboard', User::class)) {
            Log::info("ITS A ADMIN");
            return redirect()->intended(RouteServiceProvider::HOMEadmin);
        }

        abort(403);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
