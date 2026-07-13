<?php

namespace App\Policies;

use App\Models\Client;
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
        return $user->hasPermission("clients.view");
    }

    public function view(User $user, Client $client){
        if(! $user->hasPermission("clients.view")){
            return false;
        }

        if($user->role->name === 'admin'){
            return true;
        }

        // manager m fi ychouf ela li bi fer3o
        if ($user->role->name === 'manager') {
            return $user->branch_id !== null
                && $user->branch_id === $client->branch_id;
        }

        // client m fi ychouf ela profilo
        if ($user->role->name === 'client') {
            return $user->client_id !== null
                && $user->client_id === $client->id;
        }

        return false;

    }

    public function create(User $user){
        return $user->hasPermission('clients.create');
    }
    public function update(User $user, Client $client){
        if(! $user->hasPermission("clients.update")){
            return false;
        }

        if($user->role->name === 'admin'){
            return true;
        }

        // manager m fi y3adil ela li bi fer3o
        if ($user->role->name === 'manager') {
            return $user->branch_id !== null
                && $user->branch_id === $client->branch_id;
        }

        return false;
    }
    public function delete(User $user, Client $client){
        if(! $user->hasPermission("clients.view")){
            return false;
        }

        if($user->role->name === 'admin'){
            return true;
        }

        // manager m fi y3adil ela li bi fer3o
        if ($user->role->name === 'manager') {
            return $user->branch_id !== null
                && $user->branch_id === $client->branch_id;
        }

        return false;
    }

}
