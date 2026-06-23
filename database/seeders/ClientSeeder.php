<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'PT Indofood Sukses Makmur Tbk',
                'industry' => 'Makanan & Minuman',
                'description' => 'Perusahaan makanan terbesar di Indonesia dengan berbagai merek terkenal.',
                'website' => 'https://indofood.com',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'PT Unilever Indonesia Tbk',
                'industry' => 'FMCG',
                'description' => 'Perusahaan barang konsumen multinasional dengan produk-produk rumah tangga terkemuka.',
                'website' => 'https://unilever.co.id',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'PT Nestlé Indonesia',
                'industry' => 'Makanan & Minuman',
                'description' => 'Perusahaan makanan dan minuman global dengan berbagai produk berkualitas.',
                'website' => 'https://nestle.co.id',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'PT Mayora Indah Tbk',
                'industry' => 'Makanan & Minuman',
                'description' => 'Perusahaan makanan dan minuman dengan merek-merek seperti Kopiko, Beng-Beng, dan Torabika.',
                'website' => 'https://mayora.com',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'name' => 'PT Kalbe Farma Tbk',
                'industry' => 'Farmasi',
                'description' => 'Perusahaan farmasi terbesar di Indonesia dengan produk obat-obatan dan suplemen kesehatan.',
                'website' => 'https://kalbe.co.id',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'PT Charoen Pokphand Indonesia Tbk',
                'industry' => 'Peternakan',
                'description' => 'Perusahaan pakan ternak dan pengolahan daging ayam terkemuka di Indonesia.',
                'website' => 'https://cp.co.id',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'PT Wings Group',
                'industry' => 'FMCG',
                'description' => 'Perusahaan barang konsumen dengan produk kebersihan dan rumah tangga.',
                'website' => 'https://wingsgroup.com',
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'PT Sinar Mas Agribusiness and Food',
                'industry' => 'Agribisnis',
                'description' => 'Perusahaan agribisnis dengan produk minyak goreng, margarin, dan lemak khusus.',
                'website' => 'https://sinarmas-agri.com',
                'is_featured' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($clients as $data) {
            Client::firstOrCreate(
                ['name' => $data['name']],
                [
                    'industry' => $data['industry'],
                    'description' => $data['description'],
                    'website' => $data['website'],
                    'is_featured' => $data['is_featured'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                ]
            );
        }
    }
}
