<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    protected $model = Quotation::class;

    private static int $quoteCounter = 1000;

    public function definition(): array
    {
        static::$quoteCounter++;
        $subtotal = fake()->randomFloat(2, 10000000, 500000000);
        $discountAmount = fake()->boolean(40) ? $subtotal * fake()->randomFloat(2, 0.02, 0.10) : 0;
        $taxAmount = ($subtotal - $discountAmount) * 0.11;
        $totalAmount = $subtotal - $discountAmount + $taxAmount;

        return [
            'customer_id' => Customer::factory(),
            'lead_id' => fake()->optional(0.5)->passthrough(Lead::factory()),
            'sales_id' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
            'quotation_number' => 'QTN-' . date('Ymd') . '-' . static::$quoteCounter,
            'title' => fake()->sentence(4),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'valid_until' => fake()->dateTimeBetween('+1 week', '+3 months'),
            'status' => fake()->randomElement(['draft', 'sent', 'approved', 'rejected', 'expired']),
            'terms_conditions' => fake()->paragraphs(2, true),
            'notes' => fake()->optional(0.5)->paragraph(),
            'approved_at' => null,
            'rejected_at' => null,
            'rejection_reason' => null,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'approved',
            'approved_at' => now(),
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejection_reason' => fake()->randomElement([
                'Harga terlalu tinggi',
                'Memilih penawaran lain',
                'Proyek dibatalkan',
                'Syarat pembayaran tidak sesuai',
            ]),
        ]);
    }
}
