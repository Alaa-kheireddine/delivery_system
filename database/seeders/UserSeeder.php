<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainBranch = Branch::where('name', 'Main Branch')->first();

        $saidaBranch = Branch::where('name', 'Saida Branch')->first();

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'phone' => '03000000',
                'password' => Hash::make('password'),
                'salary' => null,
                'is_active' => true,
                'branch_id' => $mainBranch?->id,
                'role_id' => $adminRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'main-manager@example.com'],
            [
                'name' => 'Manager User',
                'phone' => '03000001',
                'password' => Hash::make('password'),
                'salary' => 800.00,
                'is_active' => true,
                'branch_id' => $mainBranch?->id,
                'role_id' => $managerRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'saida-manager@example.com'],
            [
                'name' => 'Manager Saida',
                'phone' => '03000002',
                'password' => Hash::make('password'),
                'salary' => 800.00,
                'is_active' => true,
                'branch_id' => $saidaBranch?->id,
                'role_id' => $managerRole->id,
            ]
        );
    }
}
