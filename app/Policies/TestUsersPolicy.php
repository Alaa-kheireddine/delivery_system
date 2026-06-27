<?php

namespace App\Policies;

use App\Models\User;

class TestUsersPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user){
        return $user->hasPermission('users.view'); // true , false
    }
}
