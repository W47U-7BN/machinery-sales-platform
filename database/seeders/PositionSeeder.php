<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['name' => 'Direktur Utama', 'code' => 'DIRUT', 'department_code' => 'DIR'],
            ['name' => 'Direktur', 'code' => 'DIR', 'department_code' => 'DIR'],
            ['name' => 'General Manager', 'code' => 'GM', 'department_code' => 'DIR'],
            ['name' => 'Manager Sales', 'code' => 'MGR-SLS', 'department_code' => 'SLS'],
            ['name' => 'Sales Executive', 'code' => 'SLS-EXEC', 'department_code' => 'SLS'],
            ['name' => 'Staff Marketing', 'code' => 'MKT-STF', 'department_code' => 'SLS'],
            ['name' => 'Manager Teknik', 'code' => 'MGR-TNK', 'department_code' => 'TNK'],
            ['name' => 'Teknisi', 'code' => 'TNK-STF', 'department_code' => 'TNK'],
            ['name' => 'Manager Keuangan', 'code' => 'MGR-KEU', 'department_code' => 'KEU'],
            ['name' => 'Staff Akuntansi', 'code' => 'AKT-STF', 'department_code' => 'KEU'],
            ['name' => 'Manager Gudang', 'code' => 'MGR-WHL', 'department_code' => 'WHL'],
            ['name' => 'Staff Gudang', 'code' => 'WHL-STF', 'department_code' => 'WHL'],
            ['name' => 'Customer Service', 'code' => 'CS-STF', 'department_code' => 'CS'],
            ['name' => 'Manager HRD', 'code' => 'MGR-HRD', 'department_code' => 'HRD'],
            ['name' => 'Staff HRD', 'code' => 'HRD-STF', 'department_code' => 'HRD'],
            ['name' => 'IT Staff', 'code' => 'IT-STF', 'department_code' => 'IT'],
        ];

        foreach ($positions as $pos) {
            $dept = Department::where('code', $pos['department_code'])->first();
            if ($dept) {
                Position::firstOrCreate(
                    ['code' => $pos['code']],
                    [
                        'name' => $pos['name'],
                        'department_id' => $dept->id,
                    ]
                );
            }
        }
    }
}
