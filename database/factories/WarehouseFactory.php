<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->unique()->bothify('WH-###')),
            'name' => fake()->unique()->randomElement([
                'Gudang Jakarta Pusat',
                'Gudang Surabaya Timur',
                'Gudang Bandung Utara',
            ]),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung']),
            'state' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat']),
            'postal_code' => fake()->numerify('#####'),
            'country' => 'Indonesia',
            'phone' => fake()->numerify('021-#######'),
            'email' => fake()->unique()->companyEmail(),
            'is_active' => true,
            'is_main' => fn(array $attrs) => $attrs['city'] === 'Jakarta',
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }

    public function main(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_main' => true,
        ]);
    }
}
