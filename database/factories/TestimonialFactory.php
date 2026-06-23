<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        $testimonials = [
            [
                'customer_name' => 'Budi Santoso',
                'company' => 'PT Maju Jaya Abadi',
                'position' => 'Direktur Utama',
                'content' => 'Mesin dari perusahaan ini sangat berkualitas dan tahan lama. Setelah 3 tahun pemakaian, performanya masih sangat baik. Tim teknisi juga sangat responsif dalam menangani perawatan.',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Siti Rahmawati',
                'company' => 'CV Karya Mandiri Sejahtera',
                'position' => 'Manajer Produksi',
                'content' => 'Pelayanan purna jual yang sangat memuaskan. Setiap kali ada kendala, tim teknisi selalu siap membantu. Mesin roasting kopinya sangat membantu meningkatkan produksi kami.',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Ahmad Fauzi',
                'company' => 'UD Sumber Rejeki',
                'position' => 'Pemilik',
                'content' => 'Harga terjangkau dengan kualitas yang tidak kalah dengan merek impor. Mesin packaging vertikalnya sangat efisien dan menghemat waktu produksi kami hingga 40%.',
                'rating' => 5,
            ],
            [
                'customer_name' => 'Dewi Sartika',
                'company' => 'PT Indah Jaya Makmur',
                'position' => 'Kepala Teknik',
                'content' => 'Boiler kapasitas 2 ton yang kami beli sangat handal. Konsumsi bahan bakarnya efisien dan perawatannya mudah. Sangat direkomendasikan untuk industri pengolahan.',
                'rating' => 4,
            ],
            [
                'customer_name' => 'Hendra Gunawan',
                'company' => 'CV Sinar Jaya Teknik',
                'position' => 'Owner',
                'content' => 'Sudah menjadi langganan sejak 2018. Pelayanan cepat, produk berkualitas, dan harga bersahabat. Conveyor system yang mereka buat sangat presisi sesuai kebutuhan pabrik kami.',
                'rating' => 5,
            ],
        ];

        $testimonial = fake()->randomElement($testimonials);

        return [
            'customer_id' => fake()->optional(0.7)->passthrough(Customer::factory()),
            'customer_name' => $testimonial['customer_name'],
            'company' => $testimonial['company'],
            'position' => $testimonial['position'],
            'content' => $testimonial['content'],
            'rating' => $testimonial['rating'],
            'image' => null,
            'video_url' => null,
            'is_featured' => fake()->boolean(40),
            'is_active' => true,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
