<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mesin Pengolahan Makanan',
                'slug' => 'mesin-pengolahan-makanan',
                'description' => 'Mesin untuk industri pengolahan makanan seperti penggiling, mixer, oven, dan lainnya',
                'icon' => 'bi bi-cup-hot',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Minuman',
                'slug' => 'mesin-minuman',
                'description' => 'Mesin untuk produksi minuman, filling, dan pengemasan minuman',
                'icon' => 'bi bi-cup-straw',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Packaging',
                'slug' => 'mesin-packaging',
                'description' => 'Mesin pengemasan dan packaging untuk berbagai produk industri',
                'icon' => 'bi bi-box-seam',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Pertanian',
                'slug' => 'mesin-pertanian',
                'description' => 'Alat dan mesin pertanian modern untuk budidaya dan pasca panen',
                'icon' => 'bi bi-flower1',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Peternakan',
                'slug' => 'mesin-peternakan',
                'description' => 'Mesin untuk peternakan, pakan ternak, dan pengolahan hasil peternakan',
                'icon' => 'bi bi-gender-neuter',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Perikanan',
                'slug' => 'mesin-perikanan',
                'description' => 'Mesin untuk budidaya perikanan, pakan ikan, dan pengolahan hasil laut',
                'icon' => 'bi bi-water',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Industri',
                'slug' => 'mesin-industri',
                'description' => 'Mesin serbaguna untuk keperluan industri umum',
                'icon' => 'bi bi-gear-wide-connected',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Mesin Farmasi',
                'slug' => 'mesin-farmasi',
                'description' => 'Mesin untuk industri farmasi dan kesehatan',
                'icon' => 'bi bi-capsule',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Boiler',
                'slug' => 'boiler',
                'description' => 'Boiler steam dan thermal oil heater untuk kebutuhan industri',
                'icon' => 'bi bi-fire',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Generator',
                'slug' => 'generator',
                'description' => 'Generator set dan power supply untuk kebutuhan kelistrikan',
                'icon' => 'bi bi-lightning',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Conveyor',
                'slug' => 'conveyor',
                'description' => 'Sistem conveyor untuk material handling dan transportasi barang',
                'icon' => 'bi bi-arrow-left-right',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Sparepart',
                'slug' => 'sparepart',
                'description' => 'Suku cadang dan komponen untuk mesin industri',
                'icon' => 'bi bi-tools',
                'sort_order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
