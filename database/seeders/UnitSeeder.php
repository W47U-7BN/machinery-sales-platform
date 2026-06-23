<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Pcs', 'short_name' => 'Pcs', 'is_active' => true],
            ['name' => 'Unit', 'short_name' => 'Unit', 'is_active' => true],
            ['name' => 'Set', 'short_name' => 'Set', 'is_active' => true],
            ['name' => 'Kg', 'short_name' => 'Kg', 'is_active' => true],
            ['name' => 'Meter', 'short_name' => 'M', 'is_active' => true],
            ['name' => 'Liter', 'short_name' => 'L', 'is_active' => true],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate(['name' => $unit['name']], $unit);
        }
    }
}
