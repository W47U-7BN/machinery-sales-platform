<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'category' => 'Produk',
                'question' => 'Apakah produk mesin industri ini bergaransi?',
                'answer' => 'Ya, semua produk mesin industri kami dilengkapi garansi resmi minimal 1 tahun. Untuk mesin tertentu, garansi dapat diperpanjang hingga 5 tahun dengan syarat dan ketentuan berlaku.',
                'sort_order' => 1,
            ],
            [
                'category' => 'Produk',
                'question' => 'Bagaimana cara memilih mesin yang tepat untuk bisnis saya?',
                'answer' => 'Kami menyarankan untuk berkonsultasi dengan tim sales kami yang berpengalaman. Mereka akan membantu menganalisis kebutuhan produksi Anda dan merekomendasikan mesin yang paling sesuai dengan budget dan kapasitas yang dibutuhkan.',
                'sort_order' => 2,
            ],
            [
                'category' => 'Pemesanan',
                'question' => 'Bagaimana cara memesan produk?',
                'answer' => 'Anda dapat memesan melalui website, menghubungi WhatsApp kami di nomor yang tertera, atau datang langsung ke kantor kami. Tim sales kami akan membantu proses pemesanan dari awal hingga akhir.',
                'sort_order' => 3,
            ],
            [
                'category' => 'Pembayaran',
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer' => 'Kami menerima pembayaran melalui Transfer Bank (BCA, Mandiri, BNI, BRI), Kartu Kredit, Cash, dan pembayaran melalui virtual account. Untuk pembelian dengan nilai besar, tersedia juga opsi pembayaran bertahap.',
                'sort_order' => 4,
            ],
            [
                'category' => 'Pengiriman',
                'question' => 'Berapa lama waktu pengiriman mesin?',
                'answer' => 'Waktu pengiriman bervariasi tergantung ketersediaan stok dan lokasi tujuan. Untuk mesin yang tersedia di gudang, pengiriman ke Jakarta dapat dilakukan dalam 1-2 hari kerja. Untuk mesin inden atau custom, waktu pengiriman 2-6 minggu.',
                'sort_order' => 5,
            ],
            [
                'category' => 'Servis',
                'question' => 'Apakah tersedia layanan instalasi dan pelatihan?',
                'answer' => 'Ya, kami menyediakan layanan instalasi mesin di tempat serta pelatihan pengoperasian untuk operator mesin. Tim teknisi kami akan datang langsung ke lokasi untuk memastikan mesin berfungsi optimal.',
                'sort_order' => 6,
            ],
            [
                'category' => 'Produk',
                'question' => 'Apakah bisa melakukan kustomisasi pada mesin?',
                'answer' => 'Tentu saja. Kami menerima permintaan kustomisasi mesin sesuai kebutuhan spesifik industri Anda. Tim engineering kami akan merancang dan memproduksi mesin sesuai spesifikasi yang diminta.',
                'sort_order' => 7,
            ],
            [
                'category' => 'Servis',
                'question' => 'Bagaimana jika mesin mengalami kerusakan?',
                'answer' => 'Segera hubungi tim customer service kami. Kami memiliki layanan call center 24 jam dan teknisi yang siap turun ke lapangan. Untuk area Jawa, teknisi dapat mencapai lokasi dalam 1x24 jam.',
                'sort_order' => 8,
            ],
            [
                'category' => 'Pembayaran',
                'question' => 'Apakah tersedia opsi kredit atau pembiayaan?',
                'answer' => 'Ya, kami bekerja sama dengan beberapa lembaga pembiayaan untuk menyediakan opsi kredit mesin dengan bunga kompetitif. Syarat dan ketentuan berlaku, silakan hubungi tim sales untuk informasi lebih lanjut.',
                'sort_order' => 9,
            ],
            [
                'category' => 'Produk',
                'question' => 'Apa perbedaan mesin baru dan mesin recondition?',
                'answer' => 'Mesin baru adalah mesin yang benar-benar baru dengan garansi penuh. Mesin recondition adalah mesin bekas yang telah diperbaiki dan direstorasi oleh teknisi ahli kami, dengan performa yang mendekati mesin baru namun dengan harga yang lebih terjangkau.',
                'sort_order' => 10,
            ],
        ];

        foreach ($faqs as $data) {
            Faq::firstOrCreate(
                ['question' => $data['question']],
                [
                    'category' => $data['category'],
                    'answer' => $data['answer'],
                    'sort_order' => $data['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
