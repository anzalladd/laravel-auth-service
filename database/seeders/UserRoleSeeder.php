<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::insert(
            [
                [
                    'role_name' => 'Admin',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 'SYSTEM'
                ],
                [
                    'role_name' => 'User',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 'SYSTEM'
                ],
            ]
        );
    }
}
