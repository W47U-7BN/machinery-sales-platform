<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVideo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVideoFactory extends Factory
{
    protected $model = ProductVideo::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'video_url' => 'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9_-]{11}'),
            'title' => fake()->sentence(4),
            'description' => fake()->sentence(),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
