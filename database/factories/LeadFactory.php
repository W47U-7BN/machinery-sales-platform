<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'product_id' => fake()->optional(0.5)->passthrough(Product::factory()),
            'assigned_to' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
            'source' => fake()->randomElement([
                'Website',
                'WhatsApp',
                'Telepon',
                'Email',
                'Referensi',
                'Media Sosial',
                'Pameran',
                'Kunjungan Lapangan',
                'Google Ads',
                'Marketplace',
            ]),
            'status' => fake()->randomElement([
                'new', 'qualified', 'proposal', 'negotiation', 'won', 'lost',
            ]),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(2, true),
            'estimated_value' => fake()->randomFloat(2, 5000000, 1000000000),
            'expected_close_date' => fake()->dateTimeBetween('now', '+6 months'),
            'notes' => fake()->optional(0.5)->paragraph(),
            'converted_at' => null,
            'converted_to_quotation_id' => null,
        ];
    }

    public function converted(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'won',
            'converted_at' => now(),
        ]);
    }

    public function lost(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'lost',
            'notes' => fake()->randomElement([
                'Harga terlalu mahal',
                'Memilih kompetitor',
                'Anggaran tidak mencukupi',
                'Proyek ditunda',
                'Tidak cocok dengan spesifikasi',
            ]),
        ]);
    }
}
