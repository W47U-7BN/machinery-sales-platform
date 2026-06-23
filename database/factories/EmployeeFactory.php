<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    private static int $employeeCounter = 100;

    public function definition(): array
    {
        static::$employeeCounter++;

        return [
            'user_id' => User::factory(),
            'employee_number' => 'EMP-' . str_pad(static::$employeeCounter, 4, '0', STR_PAD_LEFT),
            'department_id' => fn() => Department::inRandomOrder()->first()?->id ?? Department::factory(),
            'position_id' => fn(array $attrs) => Position::where('department_id', $attrs['department_id'])->inRandomOrder()->first()?->id ?? Position::factory(),
            'name' => fake()->name(),
            'phone' => fake()->numerify('08##########'),
            'email' => fake()->unique()->companyEmail(),
            'address' => fake()->streetAddress(),
            'birth_date' => fake()->dateTimeBetween('-50 years', '-20 years'),
            'hire_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
