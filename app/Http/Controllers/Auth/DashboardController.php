<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Services\DashboardService;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    function Dash(Request $request) : View {
        $user = (new DashboardService)->UserInfo($request);

        return view('dashboard', [
            'user' => $user,
            'RequestBy' => $user->id,
        ]);
    }
    function DashAdm() : View {
        $users = (new DashboardService)->DashUsersData();
        $allusers = (new DashboardService)->AllUsers();
        return view('dashboardAdm', compact(['users', 'allusers']));
    }
}
