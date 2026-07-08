<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;

class BranchPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user){
        return $user->hasPermission("branches.view");
    }
    public function view(User $user, Branch $branch){
        // check if admin or manager
        if(! $user->hasPermission('branches.view')){
            return false;
        }

        // admin
        if($user->role->name === 'admin'){
            return true;
        }

        // true eza ken hwe manager lal branch hayda
        return $user->branch_id === $branch->id;

    }
    public function create(User $user){
        return $user->hasPermission('branches.create');
    }
    public function update(User $user){
        return $user->hasPermission('branches.update');
    }
    public function activate(User $user){
        return $user->hasPermission('branches.activate');
    }

    public function deactivate(User $user){
        return $user->hasPermission('branches.deactivate');
    }

}
