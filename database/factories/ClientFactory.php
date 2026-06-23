<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'PT Indofood Sukses Makmur Tbk',
                'PT Unilever Indonesia Tbk',
                'PT Nestlé Indonesia',
                'PT Mayora Indah Tbk',
                'PT Kalbe Farma Tbk',
                'PT Charoen Pokphand Indonesia Tbk',
                'PT Wings Group',
                'PT Sinar Mas Agribusiness and Food',
            ]),
            'logo' => null,
            'industry' => fake()->randomElement([
                'Makanan & Minuman',
                'Farmasi',
                'Peternakan',
                'Agribisnis',
                'Manufaktur',
                'Kosmetik',
                'Kimia',
                'Otomotif',
            ]),
            'description' => fake()->paragraph(),
            'website' => fake()->domainName(),
            'is_featured' => fake()->boolean(50),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
