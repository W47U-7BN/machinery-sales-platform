<?php

namespace Database\Seeders;

use App\Models\CompanyInformation;
use Illuminate\Database\Seeder;

class CompanyInformationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'name' => 'PT Indo Industrial Machinery',
            'slogan' => 'Solusi Mesin Industri Terpercaya untuk Indonesia',
            'about' => 'PT Indo Industrial Machinery adalah perusahaan terkemuka dalam penyediaan mesin dan peralatan industri di Indonesia. Dengan pengalaman lebih dari 20 tahun, kami telah melayani ribuan pelanggan dari berbagai sektor industri mulai dari pengolahan makanan, farmasi, pertanian, hingga manufaktur. Kami berkomitmen untuk menyediakan produk berkualitas tinggi dengan harga kompetitif dan didukung layanan purna jual yang profesional.',
            'vision' => 'Menjadi perusahaan penyedia solusi mesin industri terdepan di Indonesia yang mendorong kemajuan industri nasional.',
            'mission' => 'Menyediakan mesin dan peralatan industri berkualitas tinggi dengan harga terjangkau. Memberikan layanan konsultasi dan purna jual terbaik. Mendukung pengembangan UMKM dan industri nasional melalui teknologi tepat guna. Menjadi mitra strategis bagi pelanggan dalam mengembangkan bisnis.',
            'address' => 'Jl. Industri Raya No. 88, Kawasan Industri Pulogadung',
            'city' => 'Jakarta Timur',
            'province' => 'DKI Jakarta',
            'postal_code' => '13920',
            'phone' => '021-12345678',
            'email' => 'info@indoindustrial.co.id',
            'whatsapp' => '6281234567890',
            'website' => 'https://indoindustrial.co.id',
            'operating_hours' => 'Senin - Jumat: 08:00 - 17:00, Sabtu: 08:00 - 14:00',
            'established_year' => 2004,
            'social_media' => json_encode([
                'instagram' => 'https://instagram.com/indoindustrial',
                'facebook' => 'https://facebook.com/indoindustrial',
                'youtube' => 'https://youtube.com/@indoindustrial',
            ]),
        ];

        CompanyInformation::firstOrCreate(['name' => $data['name']], $data);
    }
}
