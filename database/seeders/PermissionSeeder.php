<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'dashboard.view', 'group' => 'dashboard'],

            // Shipments
            ['name' => 'shipments.view', 'group' => 'shipments'],
            ['name' => 'shipments.create', 'group' => 'shipments'],
            ['name' => 'shipments.update', 'group' => 'shipments'],
            ['name' => 'shipments.delete', 'group' => 'shipments'],
            ['name' => 'shipments.change_status', 'group' => 'shipments'],
            ['name' => 'shipments.cancel', 'group' => 'shipments'],
            ['name' => 'shipments.assign', 'group' => 'shipments'],
            ['name' => 'shipments.print', 'group' => 'shipments'],
            ['name' => 'shipments.export', 'group' => 'shipments'],

            ['name' => 'shipments.pending.view', 'group' => 'shipments'],
            ['name' => 'shipments.active.view', 'group' => 'shipments'],
            ['name' => 'shipments.delivered.view', 'group' => 'shipments'],
            ['name' => 'shipments.cancelled.view', 'group' => 'shipments'],
            ['name' => 'shipments.deleted.view', 'group' => 'shipments'],

            // My Work / Employee
            ['name' => 'work.view', 'group' => 'work'],
            ['name' => 'work.assignments.view', 'group' => 'work'],
            ['name' => 'work.shipments.view', 'group' => 'work'],
            ['name' => 'work.shipments.update_status', 'group' => 'work'],
            ['name' => 'work.shipments.mark_picked_up', 'group' => 'work'],
            ['name' => 'work.shipments.mark_delivered', 'group' => 'work'],
            ['name' => 'work.shipments.mark_failed', 'group' => 'work'],
            ['name' => 'work.cash_collection.view', 'group' => 'work'],
            ['name' => 'work.cash_collection.collect', 'group' => 'work'],

            // Management
            ['name' => 'branches.view', 'group' => 'branches'],
            ['name' => 'branches.create', 'group' => 'branches'],
            ['name' => 'branches.update', 'group' => 'branches'],
            ['name' => 'branches.delete', 'group' => 'branches'],
            ['name' => 'branches.activate', 'group' => 'branches'],
            ['name' => 'branches.deactivate', 'group' => 'branches'],

            ['name' => 'clients.view', 'group' => 'clients'],
            ['name' => 'clients.create', 'group' => 'clients'],
            ['name' => 'clients.update', 'group' => 'clients'],
            ['name' => 'clients.delete', 'group' => 'clients'],
            ['name' => 'clients.activate', 'group' => 'clients'],
            ['name' => 'clients.deactivate', 'group' => 'clients'],

            ['name' => 'customers.view', 'group' => 'customers'],
            ['name' => 'customers.create', 'group' => 'customers'],
            ['name' => 'customers.update', 'group' => 'customers'],
            ['name' => 'customers.delete', 'group' => 'customers'],
            ['name' => 'customers.activate', 'group' => 'customers'],
            ['name' => 'customers.deactivate', 'group' => 'customers'],

            ['name' => 'assignments.view', 'group' => 'assignments'],
            ['name' => 'assignments.create', 'group' => 'assignments'],
            ['name' => 'assignments.update', 'group' => 'assignments'],
            ['name' => 'assignments.delete', 'group' => 'assignments'],
            ['name' => 'assignments.assign_employee', 'group' => 'assignments'],
            ['name' => 'assignments.unassign_employee', 'group' => 'assignments'],

            // Finance
            ['name' => 'expenses.view', 'group' => 'expenses'],
            ['name' => 'expenses.create', 'group' => 'expenses'],
            ['name' => 'expenses.update', 'group' => 'expenses'],
            ['name' => 'expenses.delete', 'group' => 'expenses'],
            ['name' => 'expenses.approve', 'group' => 'expenses'],
            ['name' => 'expenses.reject', 'group' => 'expenses'],

            ['name' => 'payments.view', 'group' => 'payments'],
            ['name' => 'payments.create', 'group' => 'payments'],
            ['name' => 'payments.update', 'group' => 'payments'],
            ['name' => 'payments.delete', 'group' => 'payments'],
            ['name' => 'payments.refund', 'group' => 'payments'],

            ['name' => 'cash_collection.view', 'group' => 'cash_collection'],
            ['name' => 'cash_collection.collect', 'group' => 'cash_collection'],
            ['name' => 'cash_collection.update', 'group' => 'cash_collection'],
            ['name' => 'cash_collection.confirm', 'group' => 'cash_collection'],
            ['name' => 'cash_collection.export', 'group' => 'cash_collection'],

            // Reports
            ['name' => 'reports.view', 'group' => 'reports'],
            ['name' => 'reports.shipments.view', 'group' => 'reports'],
            ['name' => 'reports.finance.view', 'group' => 'reports'],
            ['name' => 'reports.export', 'group' => 'reports'],

            // System
            ['name' => 'recent_actions.view', 'group' => 'recent_actions'],

            ['name' => 'notifications.view', 'group' => 'notifications'],
            ['name' => 'notifications.create', 'group' => 'notifications'],
            ['name' => 'notifications.send', 'group' => 'notifications'],
            ['name' => 'notifications.delete', 'group' => 'notifications'],

            ['name' => 'whatsapp.view', 'group' => 'whatsapp'],
            ['name' => 'whatsapp.send', 'group' => 'whatsapp'],
            ['name' => 'whatsapp.templates.view', 'group' => 'whatsapp'],
            ['name' => 'whatsapp.templates.create', 'group' => 'whatsapp'],
            ['name' => 'whatsapp.templates.update', 'group' => 'whatsapp'],
            ['name' => 'whatsapp.templates.delete', 'group' => 'whatsapp'],

            ['name' => 'chats.view', 'group' => 'chats'],
            ['name' => 'chats.reply', 'group' => 'chats'],
            ['name' => 'chats.close', 'group' => 'chats'],

            // Administration
            ['name' => 'users.view', 'group' => 'users'],
            ['name' => 'users.create', 'group' => 'users'],
            ['name' => 'users.update', 'group' => 'users'],
            ['name' => 'users.delete', 'group' => 'users'],
            ['name' => 'users.activate', 'group' => 'users'],
            ['name' => 'users.deactivate', 'group' => 'users'],
            ['name' => 'users.reset_password', 'group' => 'users'],
            ['name' => 'users.assign_role', 'group' => 'users'],

            ['name' => 'roles.view', 'group' => 'roles'],
            ['name' => 'roles.create', 'group' => 'roles'],
            ['name' => 'roles.update', 'group' => 'roles'],
            ['name' => 'roles.delete', 'group' => 'roles'],

            ['name' => 'permissions.view', 'group' => 'permissions'],
            ['name' => 'permissions.create', 'group' => 'permissions'],
            ['name' => 'permissions.update', 'group' => 'permissions'],
            ['name' => 'permissions.delete', 'group' => 'permissions'],

            ['name' => 'settings.view', 'group' => 'settings'],
            ['name' => 'settings.update', 'group' => 'settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['group' => $permission['group']]
            );
        }
    }
}