<?php

namespace App\Http\Services;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardService {
    private $user;
    public function __construct() {
        $this->user = new User;
    }
    
    function DashUsersData(): \Illuminate\Contracts\Pagination\LengthAwarePaginator {
        
        return $this->user::select(['name', 'created_at', 'role', 'id'])->paginate(5);
    }

    function UserInfo(Request $request) : User {
        return $request->user();
    }

    function AllUsers(): \Illuminate\Database\Eloquent\Collection {
        return $this->user::query()->get(['created_at', 'role']);
    }
}
