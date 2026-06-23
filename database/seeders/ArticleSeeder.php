<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $authorIds = User::pluck('id')->toArray();

        $articles = [
            [
                'title' => 'Panduan Memilih Mesin Pengolahan Makanan yang Tepat',
                'content' => "<p>Memilih mesin pengolahan makanan yang tepat adalah langkah krusial dalam memulai atau mengembangkan bisnis makanan. Artikel ini akan membahas faktor-faktor penting yang perlu dipertimbangkan.</p><h2>1. Kenali Kebutuhan Produksi</h2><p>Langkah pertama adalah menentukan kapasitas produksi yang dibutuhkan. Apakah Anda memulai usaha skala rumah tangga atau sudah memasuki industri menengah? Mesin dengan kapasitas terlalu besar akan boros investasi, sementara kapasitas terlalu kecil akan menghambat pertumbuhan.</p><h2>2. Kualitas Material</h2><p>Pastikan mesin terbuat dari material food grade, terutama stainless steel 304 atau 316 yang tahan karat dan aman untuk makanan. Hindari mesin dengan material yang mengandung zat berbahaya.</p><h2>3. Garansi dan Layanan Purna Jual</h2><p>Pilih produk yang menawarkan garansi minimal 1 tahun dan memiliki pusat layanan yang mudah dijangkau. Hal ini penting untuk menjaga kelangsungan produksi Anda.</p><h2>4. Efisiensi Energi</h2><p>Mesin dengan konsumsi energi rendah akan menghemat biaya operasional jangka panjang. Perhatikan rating daya dan konsumsi listrik sebelum memutuskan pembelian.</p><h2>5. Kemudahan Operasi</h2><p>Pilih mesin yang mudah dioperasikan dan dirawat. Mesin dengan panel kontrol digital umumnya lebih mudah digunakan dibandingkan sistem manual.</p>",
                'excerpt' => 'Panduan lengkap memilih mesin pengolahan makanan sesuai kebutuhan bisnis Anda. Pelajari faktor penting sebelum membeli mesin industri.',
                'tags' => 'mesin,makanan,pengolahan,panduan,industri',
                'status' => 'published',
            ],
            [
                'title' => 'Tips Perawatan Mesin Industri Agar Awet',
                'content' => "<p>Perawatan mesin industri yang rutin dan tepat akan memperpanjang umur mesin dan menghindari kerusakan mendadak yang bisa mengganggu produksi.</p><h2>1. Jadwal Perawatan Rutin</h2><p>Buatlah jadwal perawatan harian, mingguan, dan bulanan. Bersihkan mesin setiap selesai produksi dan lakukan pengecekan komponen kritis secara berkala.</p><h2>2. Pelumasan</h2><p>Pastikan semua bagian yang bergerak mendapat pelumasan yang cukup. Gunakan pelumas yang sesuai dengan spesifikasi pabrik.</p><h2>3. Pengecekan Kelistrikan</h2><p>Periksa kabel, saklar, dan komponen kelistrikan secara rutin. Kabel yang terkelupas atau konsleting bisa menyebabkan kerusakan serius.</p><h2>4. Kalibrasi</h2><p>Lakukan kalibrasi secara berkala untuk memastikan mesin bekerja sesuai spesifikasi. Mesin yang tidak terkalibrasi dapat menghasilkan produk dengan kualitas rendah.</p>",
                'excerpt' => 'Tips merawat mesin industri agar awet dan tahan lama. Panduan perawatan rutin untuk menjaga performa mesin.',
                'tags' => 'mesin,perawatan,industri,tips,maintenance',
                'status' => 'published',
            ],
            [
                'title' => 'Inovasi Teknologi Mesin Packaging Terbaru 2025',
                'content' => "<p>Industri packaging terus berkembang dengan inovasi teknologi baru yang meningkatkan efisiensi dan kualitas pengemasan.</p><h2>1. Mesin Packaging Otomatis dengan IoT</h2><p>Mesin packaging modern kini dilengkapi konektivitas IoT yang memungkinkan monitoring produksi secara real-time melalui smartphone. Fitur ini membantu manajer produksi memantau kinerja mesin dari mana saja.</p><h2>2. Sistem Pengemasan Ramah Lingkungan</h2><p>Teknologi terbaru memungkinkan penggunaan material biodegradable dan recyclable tanpa mengurangi kecepatan dan kualitas pengemasan.</p><h2>3. Integrasi AI untuk Quality Control</h2><p>Sistem kecerdasan buatan kini diintegrasikan ke mesin packaging untuk mendeteksi cacat produk secara otomatis, mengurangi limbah, dan meningkatkan konsistensi kualitas.</p>",
                'excerpt' => 'Inovasi terbaru teknologi mesin packaging 2025 termasuk IoT, material ramah lingkungan, dan AI untuk quality control.',
                'tags' => 'packaging,teknologi,mesin,inovasi,2025',
                'status' => 'published',
            ],
            [
                'title' => 'Cara Meningkatkan Efisiensi Produksi dengan Conveyor',
                'content' => "<p>Sistem conveyor yang tepat dapat meningkatkan efisiensi produksi secara signifikan. Berikut adalah cara mengoptimalkan penggunaan conveyor di pabrik Anda.</p><h2>1. Desain Layout yang Tepat</h2><p>Rancang layout conveyor yang meminimalkan jarak tempuh material dan menghindari bottleneck. Gunakan software simulasi untuk menguji layout sebelum implementasi.</p><h2>2. Pemilihan Jenis Conveyor</h2><p>Sesuaikan jenis conveyor dengan material yang akan diangkut. Belt conveyor cocok untuk material ringan, screw conveyor untuk material bubuk, dan roller conveyor untuk barang kemasan.</p><h2>3. Otomatisasi dan Integrasi</h2><p>Integrasikan conveyor dengan sistem produksi lainnya seperti mesin packaging dan sistem sortasi untuk menciptakan alur produksi yang seamless.</p>",
                'excerpt' => 'Optimalkan efisiensi produksi dengan sistem conveyor yang tepat. Panduan lengkap memilih dan mengatur conveyor industri.',
                'tags' => 'conveyor,efisiensi,produksi,industri,manufaktur',
                'status' => 'published',
            ],
            [
                'title' => 'Memahami Spesifikasi Boiler untuk Industri',
                'content' => "<p>Boiler adalah komponen vital di banyak industri. Memahami spesifikasinya akan membantu Anda memilih boiler yang tepat.</p><h2>1. Kapasitas Steam</h2><p>Kapasitas boiler diukur dalam ton per jam (ton/h). Pilih kapasitas sesuai kebutuhan proses produksi Anda dengan mempertimbangkan ekspansi di masa depan.</p><h2>2. Tekanan Kerja</h2><p>Tekanan kerja boiler mempengaruhi suhu steam yang dihasilkan. Industri makanan umumnya membutuhkan tekanan 10-15 bar, sementara industri kimia bisa membutuhkan hingga 30 bar.</p><h2>3. Efisiensi Bahan Bakar</h2><p>Pilih boiler dengan efisiensi termal tinggi (>85%) untuk menghemat biaya bahan bakar. Boiler biomassa dapat menjadi alternatif yang lebih ekonomis.</p>",
                'excerpt' => 'Panduan memahami spesifikasi boiler industri termasuk kapasitas, tekanan kerja, dan efisiensi bahan bakar.',
                'tags' => 'boiler,spesifikasi,industri,steam,bahan-bakar',
                'status' => 'published',
            ],
            [
                'title' => 'Keuntungan Menggunakan Mesin Pertanian Modern',
                'content' => "<p>Mesin pertanian modern menawarkan berbagai keuntungan yang dapat meningkatkan produktivitas dan efisiensi usaha pertanian.</p><h2>1. Peningkatan Produktivitas</h2><p>Mesin modern dapat menyelesaikan pekerjaan dalam waktu yang lebih singkat dibandingkan tenaga manusia. Traktor dan combine harvester misalnya, dapat mengolah lahan dan memanen dalam hitungan jam.</p><h2>2. Efisiensi Biaya</h2><p>Meskipun investasi awal besar, mesin pertanian modern menghemat biaya operasional jangka panjang melalui pengurangan kebutuhan tenaga kerja dan peningkatan hasil panen.</p><h2>3. Presisi dan Akurasi</h2><p>Teknologi GPS dan sensor pada mesin modern memungkinkan penanaman, pemupukan, dan panen dengan presisi tinggi, mengurangi pemborosan input pertanian.</p>",
                'excerpt' => 'Mesin pertanian modern meningkatkan produktivitas, efisiensi biaya, dan presisi dalam bertani.',
                'tags' => 'pertanian,mesin,modern,produktivitas,teknologi',
                'status' => 'published',
            ],
            [
                'title' => 'Standar Keamanan Mesin Industri yang Wajib Diketahui',
                'content' => "<p>Keamanan mesin industri adalah prioritas utama yang tidak boleh diabaikan. Berikut standar keamanan yang wajib diterapkan.</p><h2>1. Guard dan Safety Device</h2><p>Setiap mesin harus dilengkapi dengan guard pelindung pada bagian bergerak dan safety device seperti emergency stop button, light curtain, dan interlock switch.</p><h2>2. Pelatihan Operator</h2><p>Pastikan setiap operator mesin telah mendapatkan pelatihan yang memadai tentang cara pengoperasian yang aman. Dokumentasikan pelatihan dan lakukan refresh secara berkala.</p><h2>3. Label Peringatan</h2><p>Pasang label peringatan pada titik-titik berbahaya di mesin. Gunakan simbol yang mudah dipahami oleh semua pekerja.</p><h2>4. Inspeksi Berkala</h2><p>Lakukan inspeksi keamanan mesin secara berkala oleh petugas K3 yang kompeten. Catat dan tindak lanjuti setiap temuan.</p>",
                'excerpt' => 'Standar keamanan mesin industri yang wajib diketahui: guard, pelatihan operator, label peringatan, dan inspeksi.',
                'tags' => 'keamanan,K3,mesin,industri,keselamatan',
                'status' => 'published',
            ],
            [
                'title' => 'Panduan Memilih Generator Sesuai Kebutuhan',
                'content' => "<p>Generator atau genset adalah solusi cadangan listrik yang penting. Berikut panduan memilih generator yang tepat.</p><h2>1. Hitung Kebutuhan Daya</h2><p>Jumlahkan total daya peralatan yang akan dijalankan secara bersamaan. Tambahkan margin 20-30% untuk keamanan.</p><h2>2. Pilih Bahan Bakar</h2><p>Generator diesel lebih irit untuk penggunaan berat dan jangka panjang. Generator bensin cocok untuk penggunaan ringan dan portabel.</p><h2>3. Pertimbangkan Kebisingan</h2><p>Untuk area perumahan atau perkantoran, pilih generator silent type dengan cabin peredam suara.</p><h2>4. Otomatisasi</h2><p>Pertimbangkan genset dengan ATS (Automatic Transfer Switch) yang otomatis menyala saat listrik padam.</p>",
                'excerpt' => 'Panduan memilih generator/genset sesuai kebutuhan: hitung daya, pilih bahan bakar, pertimbangkan kebisingan, dan otomatisasi.',
                'tags' => 'generator,genset,listrik,daya,cadangan',
                'status' => 'published',
            ],
            [
                'title' => 'Tren Mesin Farmasi di Era Industri 4.0',
                'content' => "<p>Industri farmasi sedang bertransformasi menuju era Industri 4.0 dengan adopsi teknologi digital dan otomatisasi.</p><h2>1. Mesin dengan Konektivitas IoT</h2><p>Mesin farmasi modern dilengkapi sensor dan konektivitas yang memungkinkan monitoring parameter produksi secara real-time, memastikan kepatuhan terhadap standar GMP.</p><h2>2. Robotika dan Otomatisasi</h2><p>Penggunaan robot dalam proses filling, packaging, dan inspeksi meningkatkan akurasi dan mengurangi kontaminasi manusia.</p><h2>3. Sistem Manajemen Data</h2><p>Integrasi mesin dengan sistem MES (Manufacturing Execution System) dan ERP memungkinkan traceability lengkap dari bahan baku hingga produk jadi.</p>",
                'excerpt' => 'Tren mesin farmasi era Industri 4.0: IoT, robotika, otomatisasi, dan sistem manajemen data terintegrasi.',
                'tags' => 'farmasi,industri-4,iot,robotika,otomatisasi',
                'status' => 'published',
            ],
            [
                'title' => 'Cara Memulai Usaha Pengolahan Makanan Skala UMKM',
                'content' => "<p>Memulai usaha pengolahan makanan skala UMKM membutuhkan perencanaan matang dan pemilihan mesin yang tepat.</p><h2>1. Riset Pasar</h2><p>Tentukan produk apa yang akan dibuat dan siapa target pasarnya. Lakukan survei untuk memahami permintaan dan harga pasar.</p><h2>2. Perizinan</h2><p>Urus perizinan yang diperlukan seperti PIRT, BPOM, Sertifikat Halal, dan Nomor Induk Berusaha (NIB).</p><h2>3. Pilih Mesin Sesuai Budget</h2><p>Mulailah dengan mesin yang sesuai budget namun tetap berkualitas. Mesin multi-fungsi bisa menjadi pilihan ekonomis untuk UMKM.</p><h2>4. Standarisasi Produk</h2><p>Pastikan produk memiliki kualitas yang konsisten. Buat SOP produksi dan latih tenaga kerja dengan baik.</p>",
                'excerpt' => 'Panduan memulai usaha pengolahan makanan skala UMKM: riset pasar, perizinan, pemilihan mesin, dan standarisasi.',
                'tags' => 'UMKM,makanan,pengolahan,usaha,mesin',
                'status' => 'published',
            ],
        ];

        foreach ($articles as $data) {
            Article::firstOrCreate(
                ['slug' => str($data['title'])->slug()],
                [
                    'author_id' => !empty($authorIds) ? fake()->randomElement($authorIds) : null,
                    'title' => $data['title'],
                    'slug' => str($data['title'])->slug(),
                    'content' => $data['content'],
                    'excerpt' => $data['excerpt'],
                    'featured_image' => null,
                    'tags' => $data['tags'],
                    'status' => $data['status'],
                    'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
                    'meta_title' => $data['title'] . ' | Blog Indo Industrial Machinery',
                    'meta_description' => $data['excerpt'],
                ]
            );
        }
    }
}
