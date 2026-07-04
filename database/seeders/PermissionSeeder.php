<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'branches.view',
            'branches.create',
            'branches.update',
            'branches.activate',
            'branches.deactivate',

            'users.view',
            'users.create',
            'users.update',
            'users.activate',
            'users.deactivate',

            'roles.view',
            'roles.update_permissions',

            'clients.view',
            'clients.create',
            'clients.update',
            'clients.activate',
            'clients.deactivate',

            'shipments.view',
            'shipments.create',
            'shipments.update',
            'shipments.change_status',
            'shipments.cancel',

            'payments.view',
            'payments.create',

            'dashboard.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }
    }
}
