<?php

namespace App\Policies;

use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    public function updateByAdmin(User $admin, User $target): Response
    {

        Log::info("Target role: " . $target->role);
        if ($admin->role != 'admin') {
            return Response::deny('você não tem autorização para isso');
        }

        if ($target->role == 'admin') {
            if ($admin->genitor != true) {
                return Response::deny('você não tem autorização para isso');
            }
            return Response::allow();
        }

        return Response::allow();
    }

    //pra funcs especificas
    public function Update(User $user, User $model) : bool {
        if ($user->id === $model->id) {
            return true;
        }
    }

    public function UpdateAdmin(User $user, User $model): bool
    {
        return in_array($user->role, ['admin']);
    }

    public function UpdateGenitor(User $user, User $model) : bool {
        if ($user->genitor == true) {
            return in_array($user->genitor, ['genitor']);
        }else return false;

    }

    //pra dash
    public function accessUserDashboard(User $user): bool
    {
        return $user->role === 'user';
    }

    public function accessAdminDashboard(User $user): bool
    {
        return $user->role === 'admin';
    }
    public function acessGenitorDashboard(User $user) : bool {
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
