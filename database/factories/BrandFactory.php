<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'IndoMesin Teknologi',
                'AgroMech Solutions',
                'FoodPack Indo',
                'BioPharm Machinery',
                'PowerGen Industries',
            ]),
            'slug' => fn(array $attrs) => str($attrs['name'])->slug(),
            'description' => fake()->sentence(),
            'logo' => null,
            'website' => fake()->url(),
            'is_active' => true,
        ];
    }
}
