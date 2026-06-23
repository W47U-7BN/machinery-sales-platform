<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    private static int $invoiceCounter = 1000;

    public function definition(): array
    {
        static::$invoiceCounter++;
        $subtotal = fake()->randomFloat(2, 10000000, 500000000);
        $discountAmount = fake()->boolean(30) ? $subtotal * fake()->randomFloat(2, 0.02, 0.10) : 0;
        $taxAmount = ($subtotal - $discountAmount) * 0.11;
        $totalAmount = $subtotal - $discountAmount + $taxAmount;
        $paidAmount = fake()->boolean(60) ? $totalAmount : fake()->randomFloat(2, 0, $totalAmount * 0.5);
        $balanceDue = $totalAmount - $paidAmount;

        return [
            'order_id' => Order::factory(),
            'customer_id' => Customer::factory(),
            'invoice_number' => 'INV-' . date('Ymd') . '-' . static::$invoiceCounter,
            'invoice_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'due_date' => fn(array $attrs) => (new \DateTime($attrs['invoice_date']->format('Y-m-d')))->modify('+30 days'),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'balance_due' => $balanceDue,
            'status' => $balanceDue <= 0 ? 'paid' : fake()->randomElement(['pending', 'sent', 'overdue']),
            'notes' => fake()->optional(0.4)->paragraph(),
            'terms_conditions' => fake()->paragraphs(2, true),
            'sent_at' => fake()->optional(0.7)->dateTimeBetween('-2 months', 'now'),
            'paid_at' => $balanceDue <= 0 ? fake()->dateTimeBetween('-2 months', 'now') : null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'paid',
            'paid_amount' => fn(array $attrs) => $attrs['total_amount'],
            'balance_due' => 0,
            'paid_at' => now(),
        ]);
    }

    public function overdue(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'overdue',
            'due_date' => now()->subDays(fake()->numberBetween(1, 60)),
            'paid_amount' => 0,
            'balance_due' => fn(array $attrs) => $attrs['total_amount'],
        ]);
    }
}
