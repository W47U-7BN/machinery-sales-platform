<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        $units = [
            'Pcs' => 'Pcs',
            'Unit' => 'Unit',
            'Set' => 'Set',
            'Kg' => 'Kg',
            'Meter' => 'M',
            'Liter' => 'L',
        ];

        $name = fake()->unique()->randomElement(array_keys($units));

        return [
            'name' => $name,
            'short_name' => $units[$name],
            'is_active' => true,
        ];
    }
}
