<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->unique()->randomElement([
                'PT Baja Kuat Perkasa',
                'CV Elektrik Mandiri',
                'PT Komponen Industri',
                'CV Bahan Baku Utama',
                'PT Logam Jaya Abadi',
                'CV Teknik Sejahtera',
                'PT Sarana Industri',
                'UD Sumber Bahan',
                'PT Mesin Parts Indonesia',
                'CV Karet & Plastik Industri',
            ]),
            'contact_person' => fake()->name(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->numerify('08##########'),
            'alternative_phone' => fake()->optional(0.5)->numerify('021-########'),
            'website' => fake()->optional(0.5)->domainName(),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Makassar', 'Denpasar', 'Tangerang', 'Bekasi']),
            'state' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah', 'DI Yogyakarta', 'Sulawesi Selatan', 'Bali', 'Banten', 'Jawa Barat']),
            'postal_code' => fake()->numerify('#####'),
            'country' => 'Indonesia',
            'tax_id' => fake()->numerify('##.###.###.#-###.###'),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 15', 'Net 60', 'DP 30%']),
            'lead_time_days' => fake()->numberBetween(3, 60),
            'notes' => fake()->optional(0.3)->sentence(),
            'is_active' => true,
            'rating' => fake()->numberBetween(3, 5),
        ];
    }
}
