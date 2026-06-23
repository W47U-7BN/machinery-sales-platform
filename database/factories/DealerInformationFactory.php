<?php

namespace Database\Factories;

use App\Models\DealerInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealerInformationFactory extends Factory
{
    protected $model = DealerInformation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'dealer_code' => strtoupper(fake()->unique()->bothify('DLR-####')),
            'company_name' => fake()->unique()->randomElement([
                'CV Mitra Teknik Sejahtera',
                'PT Sinar Mesin Nusantara',
                'UD Jaya Abadi Teknik',
            ]),
            'phone' => fake()->numerify('08##########'),
            'email' => fake()->unique()->companyEmail(),
            'address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Makassar']),
            'province' => fake()->randomElement(['DKI Jakarta', 'Jawa Timur', 'Jawa Barat', 'Sumatera Utara', 'Sulawesi Selatan']),
            'npwp' => fake()->numerify('##.###.###.#-###.###'),
            'license_number' => strtoupper(fake()->bothify('SIUP-####/###/###')),
            'is_active' => true,
            'commission_rate' => fake()->randomFloat(2, 2.5, 10.0),
        ];
    }
}
