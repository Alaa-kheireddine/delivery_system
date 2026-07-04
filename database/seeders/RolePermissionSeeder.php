<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();
        $manager = Role::where('name', 'manager')->first();
        $accountant = Role::where('name', 'accountant')->first();
        $collector = Role::where('name', 'collector')->first();
        $deliveryAgent = Role::where('name', 'delivery_agent')->first();
        $client = Role::where('name', 'client')->first();

        $allPermissions = Permission::pluck('id')->toArray();

        $admin->permissions()->sync($allPermissions);

        $managerPermissions = Permission::whereIn('name', [
            'branches.view',

            'users.view',

            'clients.view',
            'clients.create',
            'clients.update',

            'shipments.view',
            'shipments.create',
            'shipments.update',
            'shipments.change_status',
            'shipments.cancel',

            'payments.view',

            'dashboard.view',
        ])->pluck('id')->toArray();

        $manager->permissions()->sync($managerPermissions);

        $accountantPermissions = Permission::whereIn('name', [
            'shipments.view',
            'payments.view',
            'payments.create',
            'dashboard.view',
        ])->pluck('id')->toArray();

        $accountant->permissions()->sync($accountantPermissions);

        $collectorPermissions = Permission::whereIn('name', [
            'shipments.view',
            'shipments.change_status',
        ])->pluck('id')->toArray();

        $collector->permissions()->sync($collectorPermissions);

        $deliveryAgentPermissions = Permission::whereIn('name', [
            'shipments.view',
            'shipments.change_status',
        ])->pluck('id')->toArray();

        $deliveryAgent->permissions()->sync($deliveryAgentPermissions);

        $clientPermissions = Permission::whereIn('name', [
            'shipments.view',
            'shipments.create',
            'dashboard.view',
        ])->pluck('id')->toArray();

        $client->permissions()->sync($clientPermissions);
    }
}
