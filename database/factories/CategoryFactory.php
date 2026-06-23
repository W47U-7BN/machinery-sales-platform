<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Mesin Pengolahan Makanan',
                'Mesin Minuman',
                'Mesin Packaging',
                'Mesin Pertanian',
                'Mesin Peternakan',
                'Mesin Perikanan',
                'Mesin Industri',
                'Mesin Farmasi',
                'Boiler',
                'Generator',
                'Conveyor',
                'Sparepart',
            ]),
            'slug' => fn(array $attrs) => str($attrs['name'])->slug(),
            'description' => fake()->sentence(),
            'icon' => 'bi bi-gear',
            'image' => null,
            'parent_id' => null,
            'sort_order' => fake()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
