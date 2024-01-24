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
                    'role_name' => 'admin',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'role_name' => 'user',
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
