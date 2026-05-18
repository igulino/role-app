<?php

namespace App\Http\Services;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class DashboardService {
    private $user;
    public function __construct() {
        $this->user = new User;
    }

    function DashUsersData() : Collection {
        return $this->user::query()->get(['name', 'created_at', 'role']);
    }
}