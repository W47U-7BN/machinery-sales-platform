<?php

namespace Database\Seeders;

use App\Models\DealerInformation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DealerSeeder extends Seeder
{
    public function run(): void
    {
        $dealers = [
            [
                'user_name' => 'Dealer Jakarta',
                'email' => 'dealer.jakarta@perusahaan.com',
                'company_name' => 'CV Mitra Teknik Sejahtera',
                'dealer_code' => 'DLR-0001',
                'phone' => '081222222221',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
            ],
            [
                'user_name' => 'Dealer Surabaya',
                'email' => 'dealer.surabaya@perusahaan.com',
                'company_name' => 'PT Sinar Mesin Nusantara',
                'dealer_code' => 'DLR-0002',
                'phone' => '081222222222',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
            ],
            [
                'user_name' => 'Dealer Bandung',
                'email' => 'dealer.bandung@perusahaan.com',
                'company_name' => 'UD Jaya Abadi Teknik',
                'dealer_code' => 'DLR-0003',
                'phone' => '081222222223',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
            ],
        ];

        foreach ($dealers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['user_name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole('Dealer');

            DealerInformation::firstOrCreate(
                ['dealer_code' => $data['dealer_code']],
                [
                    'user_id' => $user->id,
                    'company_name' => $data['company_name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'address' => 'Jl. Contoh Dealer No. 1',
                    'city' => $data['city'],
                    'province' => $data['province'],
                    'npwp' => '01.234.567.8-999.999',
                    'license_number' => 'SIUP-1234/2024',
                    'is_active' => true,
                    'commission_rate' => fake()->randomFloat(2, 3, 8),
                ]
            );
        }
    }
}
