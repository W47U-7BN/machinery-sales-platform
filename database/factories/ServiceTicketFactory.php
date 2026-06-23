<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ServiceTicket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceTicketFactory extends Factory
{
    protected $model = ServiceTicket::class;

    private static int $ticketCounter = 1000;

    public function definition(): array
    {
        static::$ticketCounter++;

        return [
            'ticket_number' => 'SRV-' . date('Ymd') . '-' . static::$ticketCounter,
            'customer_id' => Customer::factory(),
            'product_id' => fake()->optional(0.7)->passthrough(Product::factory()),
            'assigned_to' => fake()->optional(0.6)->passthrough(User::factory()),
            'subject' => fake()->randomElement([
                'Mesin tidak mau menyala',
                'Suara berisik saat operasi',
                'Kebocoran air pendingin',
                'Produk keluar tidak sempurna',
                'Error code E-05 pada panel',
                'Mesin mati mendadak',
                'Kapasitas menurun drastis',
                'Getaran berlebih saat running',
                'Hasil produksi tidak rata',
                'Overheating setelah 2 jam',
                'Sensor tidak berfungsi',
                'Routine maintenance request',
            ]),
            'description' => fake()->paragraphs(2, true),
            'priority' => fake()->randomElement(['low', 'medium', 'high', 'critical']),
            'status' => fake()->randomElement(['open', 'in_progress', 'waiting_parts', 'resolved', 'closed']),
            'scheduled_date' => fake()->optional(0.5)->dateTimeBetween('now', '+2 weeks'),
            'completed_date' => null,
            'resolution' => null,
            'notes' => fake()->optional(0.4)->paragraph(),
            'created_by' => fn() => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }

    public function open(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'open',
            'priority' => 'high',
            'assigned_to' => null,
        ]);
    }

    public function resolved(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'resolved',
            'completed_date' => now(),
            'resolution' => fake()->randomElement([
                'Mengganti sensor suhu yang rusak',
                'Membersihkan filter udara dan kondensor',
                'Menyetel ulang kalibrasi mesin',
                'Mengganti belt conveyor yang aus',
                'Melakukan pelumasan pada bearing',
                'Mengganti pompa air yang bocor',
                'Update firmware controller',
            ]),
        ]);
    }
}
