<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Super Admin', 'email' => 'superadmin@perusahaan.com', 'role' => 'Super Admin'],
            ['name' => 'Direktur', 'email' => 'direktur@perusahaan.com', 'role' => 'Direktur'],
            ['name' => 'General Manager', 'email' => 'gm@perusahaan.com', 'role' => 'General Manager'],
            ['name' => 'Sales Manager', 'email' => 'salesmanager@perusahaan.com', 'role' => 'Sales Manager'],
            ['name' => 'Sales', 'email' => 'sales@perusahaan.com', 'role' => 'Sales'],
            ['name' => 'Marketing', 'email' => 'marketing@perusahaan.com', 'role' => 'Marketing'],
            ['name' => 'Teknisi', 'email' => 'teknisi@perusahaan.com', 'role' => 'Teknisi'],
            ['name' => 'Warehouse', 'email' => 'warehouse@perusahaan.com', 'role' => 'Warehouse'],
            ['name' => 'Finance', 'email' => 'finance@perusahaan.com', 'role' => 'Finance'],
            ['name' => 'Customer Service', 'email' => 'cs@perusahaan.com', 'role' => 'Customer Service'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}
