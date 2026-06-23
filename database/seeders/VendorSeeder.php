<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VendorInformation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            [
                'user_name' => 'Vendor Bahan Baku',
                'email' => 'vendor.bahan@perusahaan.com',
                'company_name' => 'CV Bahan Baku Utama',
                'vendor_code' => 'VDR-0001',
                'phone' => '081333333331',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
            ],
            [
                'user_name' => 'Vendor Komponen',
                'email' => 'vendor.komponen@perusahaan.com',
                'company_name' => 'PT Komponen Industri Jaya',
                'vendor_code' => 'VDR-0002',
                'phone' => '081333333332',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
            ],
            [
                'user_name' => 'Vendor Logistik',
                'email' => 'vendor.logistik@perusahaan.com',
                'company_name' => 'Logistik Mandiri Bersama',
                'vendor_code' => 'VDR-0003',
                'phone' => '081333333333',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
            ],
        ];

        foreach ($vendors as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['user_name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole('Vendor');

            VendorInformation::firstOrCreate(
                ['vendor_code' => $data['vendor_code']],
                [
                    'user_id' => $user->id,
                    'company_name' => $data['company_name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'address' => 'Jl. Contoh Vendor No. 1',
                    'city' => $data['city'],
                    'province' => $data['province'],
                    'npwp' => '01.234.567.8-888.888',
                    'is_active' => true,
                ]
            );
        }
    }
}
