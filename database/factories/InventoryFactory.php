<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        $minQty = fake()->numberBetween(1, 20);
        $maxQty = $minQty * fake()->numberBetween(5, 30);

        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'rack_id' => null,
            'quantity' => fake()->numberBetween($minQty, $maxQty),
            'minimum_quantity' => $minQty,
            'maximum_quantity' => $maxQty,
            'reorder_point' => (int) ceil($minQty * 1.5),
            'unit_cost' => fake()->randomFloat(2, 500000, 50000000),
            'batch_number' => fake()->optional(0.6)->bothify('BATCH-####'),
            'expiry_date' => fake()->optional(0.3)->dateTimeBetween('+1 month', '+2 years'),
            'is_active' => true,
        ];
    }

    public function lowStock(): static
    {
        return $this->state(fn(array $attributes) => [
            'quantity' => fn(array $attrs) => (int) floor($attrs['minimum_quantity'] * 0.5),
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn(array $attributes) => [
            'quantity' => 0,
        ]);
    }
}
