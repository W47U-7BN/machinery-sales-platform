<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            [
                'code' => 'WH-JKT-01',
                'name' => 'Gudang Jakarta Pusat',
                'address' => 'Jl. Raya Industri No. 100, Kawasan Industri Pulogadung',
                'city' => 'Jakarta',
                'state' => 'DKI Jakarta',
                'postal_code' => '13920',
                'phone' => '021-12345670',
                'email' => 'gudang.jakarta@indoindustrial.co.id',
                'is_active' => true,
                'is_main' => true,
                'notes' => 'Gudang utama pusat distribusi nasional',
            ],
            [
                'code' => 'WH-SBY-01',
                'name' => 'Gudang Surabaya Timur',
                'address' => 'Jl. Rungkut Industri IV No. 25, Rungkut',
                'city' => 'Surabaya',
                'state' => 'Jawa Timur',
                'postal_code' => '60293',
                'phone' => '031-12345678',
                'email' => 'gudang.surabaya@indoindustrial.co.id',
                'is_active' => true,
                'is_main' => false,
                'notes' => 'Gudang distribusi wilayah Jawa Timur dan Indonesia Timur',
            ],
            [
                'code' => 'WH-BDG-01',
                'name' => 'Gudang Bandung Utara',
                'address' => 'Jl. Raya Cimahi No. 50, Cimahi Utara',
                'city' => 'Bandung',
                'state' => 'Jawa Barat',
                'postal_code' => '40512',
                'phone' => '022-12345678',
                'email' => 'gudang.bandung@indoindustrial.co.id',
                'is_active' => true,
                'is_main' => false,
                'notes' => 'Gudang distribusi wilayah Jawa Barat',
            ],
        ];

        foreach ($warehouses as $wh) {
            Warehouse::firstOrCreate(['code' => $wh['code']], $wh);
        }
    }
}
