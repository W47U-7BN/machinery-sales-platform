<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $companyTypes = ['PT', 'CV', 'Toko', 'UD', 'Fa'];

        return [
            'user_id' => null,
            'company_name' => fake()->unique()->randomElement([
                'PT Maju Jaya Abadi',
                'CV Karya Mandiri Sejahtera',
                'PT Indah Jaya Makmur',
                'CV Sinar Jaya Teknik',
                'PT Bumi Raya Perkasa',
                'UD Sumber Rejeki',
                'PT Kencana Sakti',
                'CV Agung Perdana',
                'PT Nusantara Indah',
                'Toko Mesin Jaya',
                'PT Sinar Abadi Sejahtera',
                'CV Bintang Timur',
                'PT Karya Agung',
                'UD Berkah Barokah',
                'PT Mandiri Sukses',
                'CV Karya Indah',
                'PT Surya Agung Perkasa',
                'Toko Teknik Jaya',
                'PT Cipta Karya Mandiri',
                'CV Maju Bersama',
            ]),
            'customer_type' => fake()->randomElement(['company', 'individual']),
            'tax_id' => fake()->numerify('##.###.###.#-###.###'),
            'phone' => fake()->numerify('08##########'),
            'alternative_phone' => fake()->optional(0.5)->numerify('021-########'),
            'email' => fake()->unique()->companyEmail(),
            'website' => fake()->optional(0.6)->domainName(),
            'billing_address' => [
                'street' => fake()->streetAddress(),
                'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Makassar', 'Denpasar', 'Palembang', 'Batam']),
                'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah', 'DI Yogyakarta', 'Sulawesi Selatan', 'Bali', 'Sumatera Selatan', 'Kepulauan Riau']),
                'postal_code' => fake()->numerify('#####'),
            ],
            'shipping_address' => [
                'street' => fake()->streetAddress(),
                'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Makassar', 'Denpasar', 'Palembang', 'Batam']),
                'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah', 'DI Yogyakarta', 'Sulawesi Selatan', 'Bali', 'Sumatera Selatan', 'Kepulauan Riau']),
                'postal_code' => fake()->numerify('#####'),
            ],
            'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Yogyakarta', 'Makassar', 'Denpasar', 'Palembang', 'Batam']),
            'state' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Jawa Tengah', 'DI Yogyakarta', 'Sulawesi Selatan', 'Bali', 'Sumatera Selatan', 'Kepulauan Riau']),
            'postal_code' => fake()->numerify('#####'),
            'country' => 'Indonesia',
            'notes' => fake()->optional(0.3)->sentence(),
            'credit_limit' => fake()->optional(0.7)->randomFloat(2, 50000000, 5000000000),
            'payment_terms' => fake()->randomElement(['Net 30', 'Net 15', 'Net 60', 'COD', 'DP 50%']),
            'is_active' => true,
            'registered_at' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
