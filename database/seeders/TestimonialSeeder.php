<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Budi Santoso',
                'company' => 'PT Maju Jaya Abadi',
                'position' => 'Direktur Utama',
                'content' => 'Mesin dari perusahaan ini sangat berkualitas dan tahan lama. Setelah 3 tahun pemakaian, performanya masih sangat baik. Tim teknisi juga sangat responsif dalam menangani perawatan rutin.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'customer_name' => 'Siti Rahmawati',
                'company' => 'CV Karya Mandiri Sejahtera',
                'position' => 'Manajer Produksi',
                'content' => 'Pelayanan purna jual yang sangat memuaskan. Setiap kali ada kendala, tim teknisi selalu siap membantu. Mesin roasting kopinya sangat membantu meningkatkan kapasitas produksi kami hingga 3 kali lipat.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'customer_name' => 'Ahmad Fauzi',
                'company' => 'UD Sumber Rejeki',
                'position' => 'Pemilik',
                'content' => 'Harga terjangkau dengan kualitas yang tidak kalah dengan merek impor. Mesin packaging vertikalnya sangat efisien dan menghemat waktu produksi kami hingga 40%. Highly recommended!',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'customer_name' => 'Dewi Sartika',
                'company' => 'PT Indah Jaya Makmur',
                'position' => 'Kepala Teknik',
                'content' => 'Boiler kapasitas 2 ton yang kami beli sangat handal. Konsumsi bahan bakarnya efisien dan perawatannya mudah. Tim instalasi juga bekerja profesional dan tepat waktu.',
                'rating' => 4,
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'customer_name' => 'Hendra Gunawan',
                'company' => 'CV Sinar Jaya Teknik',
                'position' => 'Owner',
                'content' => 'Sudah menjadi langganan sejak 2018. Pelayanan cepat, produk berkualitas, dan harga bersahabat. Conveyor system yang mereka buat sangat presisi sesuai kebutuhan pabrik kami.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                ['customer_name' => $data['customer_name'], 'company' => $data['company']],
                [
                    'customer_id' => null,
                    'customer_name' => $data['customer_name'],
                    'company' => $data['company'],
                    'position' => $data['position'],
                    'content' => $data['content'],
                    'rating' => $data['rating'],
                    'is_featured' => $data['is_featured'],
                    'is_active' => true,
                    'sort_order' => $data['sort_order'],
                ]
            );
        }
    }
}
