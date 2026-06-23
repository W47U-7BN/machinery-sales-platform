<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VendorInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorInformationFactory extends Factory
{
    protected $model = VendorInformation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'vendor_code' => strtoupper(fake()->unique()->bothify('VDR-####')),
            'company_name' => fake()->unique()->randomElement([
                'CV Bahan Baku Utama',
                'PT Komponen Industri Jaya',
                'Logistik Mandiri Bersama',
            ]),
            'phone' => fake()->numerify('08##########'),
            'email' => fake()->unique()->companyEmail(),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Tangerang', 'Bekasi']),
            'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Banten', 'Jawa Barat']),
            'npwp' => fake()->numerify('##.###.###.#-###.###'),
            'is_active' => true,
        ];
    }
}
