<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::firstOrCreate(
            ['name' => 'Main Branch'],
            [
                'city' => 'Beirut',
                'address' => 'Beirut, Lebanon',
                'phone' => '01000000',
                'is_active' => true,
            ]
        );

        Branch::firstOrCreate(
            ['name' => 'Saida Branch'],
            [
                'city' => 'Saida',
                'address' => 'Saida, Lebanon',
                'phone' => '07000000',
                'is_active' => true,
            ]
        );
    }
}
