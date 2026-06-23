<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id', 'email')->toArray();
        $departments = Department::pluck('id', 'code')->toArray();
        $positions = Position::pluck('id', 'code')->toArray();

        $employees = [
            [
                'user_email' => 'superadmin@perusahaan.com',
                'name' => 'Super Admin',
                'employee_number' => 'EMP-0001',
                'dept_code' => 'DIR',
                'pos_code' => 'DIRUT',
                'phone' => '081111111111',
                'hire_date' => '2020-01-01',
            ],
            [
                'user_email' => 'direktur@perusahaan.com',
                'name' => 'Bambang Wijaya',
                'employee_number' => 'EMP-0002',
                'dept_code' => 'DIR',
                'pos_code' => 'DIR',
                'phone' => '081111111112',
                'hire_date' => '2020-01-15',
            ],
            [
                'user_email' => 'gm@perusahaan.com',
                'name' => 'Haryanto Sudirman',
                'employee_number' => 'EMP-0003',
                'dept_code' => 'DIR',
                'pos_code' => 'GM',
                'phone' => '081111111113',
                'hire_date' => '2020-02-01',
            ],
            [
                'user_email' => 'salesmanager@perusahaan.com',
                'name' => 'Rudi Hartono',
                'employee_number' => 'EMP-0004',
                'dept_code' => 'SLS',
                'pos_code' => 'MGR-SLS',
                'phone' => '081111111114',
                'hire_date' => '2020-03-01',
            ],
            [
                'user_email' => 'sales@perusahaan.com',
                'name' => 'Agus Prasetyo',
                'employee_number' => 'EMP-0005',
                'dept_code' => 'SLS',
                'pos_code' => 'SLS-EXEC',
                'phone' => '081111111115',
                'hire_date' => '2021-01-10',
            ],
            [
                'user_email' => 'marketing@perusahaan.com',
                'name' => 'Dewi Lestari',
                'employee_number' => 'EMP-0006',
                'dept_code' => 'SLS',
                'pos_code' => 'MKT-STF',
                'phone' => '081111111116',
                'hire_date' => '2021-03-15',
            ],
            [
                'user_email' => 'teknisi@perusahaan.com',
                'name' => 'Supriyadi',
                'employee_number' => 'EMP-0007',
                'dept_code' => 'TNK',
                'pos_code' => 'TNK-STF',
                'phone' => '081111111117',
                'hire_date' => '2021-06-01',
            ],
            [
                'user_email' => 'warehouse@perusahaan.com',
                'name' => 'Joko Susilo',
                'employee_number' => 'EMP-0008',
                'dept_code' => 'WHL',
                'pos_code' => 'MGR-WHL',
                'phone' => '081111111118',
                'hire_date' => '2021-08-01',
            ],
            [
                'user_email' => 'finance@perusahaan.com',
                'name' => 'Sri Wahyuni',
                'employee_number' => 'EMP-0009',
                'dept_code' => 'KEU',
                'pos_code' => 'MGR-KEU',
                'phone' => '081111111119',
                'hire_date' => '2020-06-01',
            ],
            [
                'user_email' => 'cs@perusahaan.com',
                'name' => 'Ani Rahmawati',
                'employee_number' => 'EMP-0010',
                'dept_code' => 'CS',
                'pos_code' => 'CS-STF',
                'phone' => '081111111120',
                'hire_date' => '2022-01-10',
            ],
            [
                'user_email' => null,
                'name' => 'Teguh Santoso',
                'employee_number' => 'EMP-0011',
                'dept_code' => 'TNK',
                'pos_code' => 'MGR-TNK',
                'phone' => '081111111121',
                'hire_date' => '2020-04-01',
            ],
            [
                'user_email' => null,
                'name' => 'Fitri Handayani',
                'employee_number' => 'EMP-0012',
                'dept_code' => 'HRD',
                'pos_code' => 'MGR-HRD',
                'phone' => '081111111122',
                'hire_date' => '2020-05-01',
            ],
            [
                'user_email' => null,
                'name' => 'Dimas Ardiansyah',
                'employee_number' => 'EMP-0013',
                'dept_code' => 'WHL',
                'pos_code' => 'WHL-STF',
                'phone' => '081111111123',
                'hire_date' => '2022-03-01',
            ],
            [
                'user_email' => null,
                'name' => 'Rina Marlina',
                'employee_number' => 'EMP-0014',
                'dept_code' => 'KEU',
                'pos_code' => 'AKT-STF',
                'phone' => '081111111124',
                'hire_date' => '2022-06-15',
            ],
            [
                'user_email' => null,
                'name' => 'Aditya Nugraha',
                'employee_number' => 'EMP-0015',
                'dept_code' => 'IT',
                'pos_code' => 'IT-STF',
                'phone' => '081111111125',
                'hire_date' => '2023-01-10',
            ],
        ];

        foreach ($employees as $data) {
            $userId = $data['user_email'] ? ($users[$data['user_email']] ?? null) : null;

            Employee::firstOrCreate(
                ['employee_number' => $data['employee_number']],
                [
                    'user_id' => $userId,
                    'name' => $data['name'],
                    'department_id' => $departments[$data['dept_code']] ?? null,
                    'position_id' => $positions[$data['pos_code']] ?? null,
                    'phone' => $data['phone'],
                    'email' => $data['user_email'] ?? strtolower(str_replace(' ', '.', $data['name'])) . '@perusahaan.com',
                    'hire_date' => $data['hire_date'],
                    'is_active' => true,
                ]
            );
        }
    }
}
