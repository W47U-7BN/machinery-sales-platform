<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'IndoMesin Teknologi',
                'slug' => 'indomesin-teknologi',
                'description' => 'Produsen mesin industri terkemuka di Indonesia dengan produk berkualitas tinggi dan inovasi teknologi terkini.',
                'website' => 'https://indomesin.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'AgroMech Solutions',
                'slug' => 'agromech-solutions',
                'description' => 'Spesialis mesin pertanian dan peternakan modern untuk mendukung ketahanan pangan nasional.',
                'website' => 'https://agromech.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'FoodPack Indo',
                'slug' => 'foodpack-indo',
                'description' => 'Pemimpin pasar mesin packaging dan pengolahan makanan dengan solusi lengkap untuk UMKM hingga industri besar.',
                'website' => 'https://foodpackindo.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'BioPharm Machinery',
                'slug' => 'biopharm-machinery',
                'description' => 'Produsen mesin farmasi dan laboratorium yang memenuhi standar GMP dan CPOB.',
                'website' => 'https://biopharm-machinery.co.id',
                'is_active' => true,
            ],
            [
                'name' => 'PowerGen Industries',
                'slug' => 'powergen-industries',
                'description' => 'Spesialis boiler, generator, dan sistem pembangkit tenaga untuk kebutuhan industri berat.',
                'website' => 'https://powergen-industries.co.id',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::firstOrCreate(['slug' => $brand['slug']], $brand);
        }
    }
}
