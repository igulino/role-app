<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\ProfileRulesController;
use Illuminate\Support\Facades\Log;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'Dash'])->middleware(['auth', 'verified', 'RoleVerification'])->name('dashboardUser');
Route::get('/dashboardAdm', [DashboardController::class, 'DashAdm'])->middleware(['auth', 'verified', 'RoleVerification'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //edit perfil próprio 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //edit adm -> users
    Route::get('/profile/{user}', [ProfileRulesController::class, 'Quick'])->middleware('RoleVerification');
    Route::patch('/profile/update', [ProfileRulesController::class, 'updateAdm'])->name('profile.updateAdm')->defaults('context', 'UserUpdate')->middleware('RoleVerification');
    Route::put('/profile/password', [ProfileRulesController::class, 'updatePasswordAdm'])->name('password.updateAdm')->middleware('RoleVerification');
    Route::delete('/profile/delete', [ProfileRulesController::class, 'destroyAdm'])->name('profile.destroyAdm')->middleware('RoleVerification');
    
});

require __DIR__.'/auth.php';
