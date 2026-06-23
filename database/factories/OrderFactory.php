<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    private static int $orderCounter = 1000;

    public function definition(): array
    {
        static::$orderCounter++;
        $subtotal = fake()->randomFloat(2, 10000000, 500000000);
        $discountAmount = fake()->boolean(30) ? $subtotal * fake()->randomFloat(2, 0.02, 0.10) : 0;
        $taxAmount = ($subtotal - $discountAmount) * 0.11;
        $shippingCost = fake()->randomFloat(2, 500000, 10000000);
        $totalAmount = $subtotal - $discountAmount + $taxAmount + $shippingCost;

        return [
            'customer_id' => Customer::factory(),
            'quotation_id' => fake()->optional(0.6)->passthrough(Quotation::factory()),
            'sales_id' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
            'order_number' => 'ORD-' . date('Ymd') . '-' . static::$orderCounter,
            'order_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'shipping_cost' => $shippingCost,
            'total_amount' => $totalAmount,
            'payment_status' => fake()->randomElement(['unpaid', 'partial', 'paid']),
            'order_status' => fake()->randomElement(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled']),
            'shipping_address' => [
                'street' => fake()->streetAddress(),
                'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang']),
                'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah']),
                'postal_code' => fake()->numerify('#####'),
            ],
            'billing_address' => [
                'street' => fake()->streetAddress(),
                'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang']),
                'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah']),
                'postal_code' => fake()->numerify('#####'),
            ],
            'payment_method' => fake()->randomElement(['Transfer Bank', 'Kartu Kredit', 'Cash', 'Kredit']),
            'notes' => fake()->optional(0.4)->paragraph(),
            'terms_conditions' => fake()->paragraphs(2, true),
            'approved_at' => null,
            'shipped_at' => null,
            'delivered_at' => null,
        ];
    }

    public function confirmed(): static
    {
        return $this->state(fn(array $attributes) => [
            'order_status' => 'confirmed',
            'approved_at' => now(),
        ]);
    }

    public function delivered(): static
    {
        return $this->state(fn(array $attributes) => [
            'order_status' => 'delivered',
            'approved_at' => now(),
            'shipped_at' => now()->subDays(5),
            'delivered_at' => now(),
        ]);
    }
}
