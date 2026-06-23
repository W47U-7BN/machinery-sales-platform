<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Direksi', 'code' => 'DIR', 'description' => 'Direksi dan Manajemen Puncak'],
            ['name' => 'Sales & Marketing', 'code' => 'SLS', 'description' => 'Divisi Penjualan dan Pemasaran'],
            ['name' => 'Teknik', 'code' => 'TNK', 'description' => 'Divisi Teknik dan Servis'],
            ['name' => 'Keuangan', 'code' => 'KEU', 'description' => 'Divisi Keuangan dan Akuntansi'],
            ['name' => 'Warehouse & Logistik', 'code' => 'WHL', 'description' => 'Divisi Gudang dan Logistik'],
            ['name' => 'Customer Service', 'code' => 'CS', 'description' => 'Divisi Layanan Pelanggan'],
            ['name' => 'HRD & Umum', 'code' => 'HRD', 'description' => 'Divisi Sumber Daya Manusia'],
            ['name' => 'IT', 'code' => 'IT', 'description' => 'Divisi Teknologi Informasi'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(['code' => $dept['code']], $dept);
        }
    }
}
