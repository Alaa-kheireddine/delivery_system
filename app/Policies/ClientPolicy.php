<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class ClientPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user){
        return $user->hasPermission("roles.view");
    }

    public function view(User $user){
        return $user->hasPermission("roles.view");
    }
    public function create(User $user){
        return $user->hasPermission('roles.create');
    }
    public function update(User $user, Role $role){
        return $role->id !== $user->role_id && $user->hasPermission('roles.update');
    }
    public function delete(User $user, Role $role){
        return $role->id !== $user->role_id && $user->hasPermission('roles.delete');
    }

}
