<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $authUser): bool
    {
        return $authUser->hasPermission('users.view');
    }

    public function view(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.view')) {
            return false;
        }

        if ($authUser->role->name === 'admin') {
            return true;
        }

        if($targetUser->role->name === 'admin'){
            return false;
        }

        return $authUser->branch_id === $targetUser->branch_id;
    }

    public function create(User $authUser): bool
    {
        return $authUser->hasPermission('users.create');
    }

    public function update(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.update')) {
            return false;
        }

        if ($authUser->role->name === 'admin') {
            return true;
        }

        

        return $authUser->branch_id === $targetUser->branch_id;
    }

    public function activate(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.activate')) {
            return false;
        }

        if ($authUser->role->name === 'admin') {
            return true;
        }

        return $authUser->id !== $targetUser->id;
    }

    public function deactivate(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.deactivate')) {
            return false;
        }

        if ($authUser->role->name === 'admin') {
            return true;
        }

        return $authUser->id !== $targetUser->id;
    }

    public function resetPassword(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.reset_password')) { 
            return false; 
        }

        if ($authUser->role->name === 'admin') {
            return true;
        }

        // m 7ada fi ysawe reset password la admin tene ela la ykoun kamen admin
        if($targetUser->role->name === 'admin' && $authUser->role->name !== 'admin'){
            return false;
        }
        
        // Kawno howe mch admin, fa ma fi ysawe reset ella lali 3ndo bl branch 
        if (! $authUser->branch_id || $authUser->branch_id !== $targetUser->branch_id) {
            return false;
        }

        return false;
    }
}
