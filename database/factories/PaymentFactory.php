<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    private static int $paymentCounter = 1000;

    public function definition(): array
    {
        static::$paymentCounter++;

        return [
            'invoice_id' => Invoice::factory(),
            'received_by' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
            'payment_number' => 'PAY-' . date('Ymd') . '-' . static::$paymentCounter,
            'payment_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'amount' => fake()->randomFloat(2, 1000000, 50000000),
            'payment_method' => fake()->randomElement(['Transfer Bank', 'Kartu Kredit', 'Cash', 'Giro', 'Virtual Account']),
            'reference_number' => fake()->optional(0.7)->bothify('REF-########'),
            'bank_name' => fake()->randomElement([
                'Bank Mandiri',
                'Bank BCA',
                'Bank BNI',
                'Bank BRI',
                'Bank Syariah Indonesia',
                'Bank CIMB Niaga',
                'Bank Danamon',
            ]),
            'bank_account' => fake()->optional(0.8)->numerify('############'),
            'notes' => fake()->optional(0.3)->sentence(),
            'status' => fake()->randomElement(['completed', 'pending', 'failed', 'refunded']),
            'received_at' => fake()->optional(0.8)->dateTimeBetween('-3 months', 'now'),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
            'received_at' => now(),
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'failed',
            'notes' => fake()->randomElement(['Saldo tidak mencukupi', 'Data tidak valid', 'Timeout transaksi']),
        ]);
    }
}
