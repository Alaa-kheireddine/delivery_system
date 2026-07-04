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

        return $authUser->id !== $targetUser->id;
    }

    public function deactivate(User $authUser, User $targetUser): bool
    {
        if (! $authUser->hasPermission('users.deactivate')) {
            return false;
        }

        return $authUser->id !== $targetUser->id;
    }
}
