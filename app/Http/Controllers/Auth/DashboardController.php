<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Services\DashboardService;

class DashboardController extends Controller {
    function Dash() : View {
        return view('dashboard', [
            'users' => (new DashboardService)->DashUsersData(),
        ]);
    }
}