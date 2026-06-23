@extends('layouts.landing')

@section('title', 'Panduan Memilih Excavator untuk Proyek Konstruksi 2026')
@section('meta_description', 'Pelajari faktor-faktor penting dalam memilih excavator yang tepat untuk kebutuhan proyek konstruksi Anda.')

@section('content')
<section class="lp-section-sm" style="background:var(--lp-white);border-bottom:1px solid var(--lp-gray-200);padding-top:100px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['url' => route('articles.index'), 'label' => 'Artikel'], ['label' => 'Panduan Memilih Excavator']]])
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding-top:48px;">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:1fr 320px;gap:40px;">
            <div>
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=900" alt="Excavator" style="width:100%;border-radius:var(--lp-radius-2xl);box-shadow:var(--lp-shadow-lg);">

                <div style="display:flex;flex-wrap:wrap;align-items:center;gap:16px;margin-top:24px;">
                    <span class="lp-badge lp-badge-primary">Tips & Trik</span>
                    <span style="font-size:14px;color:var(--lp-gray-500);"><i class="far fa-calendar" style="margin-right:6px;"></i>15 Juni 2026</span>
                    <span style="font-size:14px;color:var(--lp-gray-500);"><i class="far fa-user" style="margin-right:6px;"></i>Tim Teknis</span>
                    <span style="font-size:14px;color:var(--lp-gray-500);"><i class="far fa-clock" style="margin-right:6px;"></i>5 menit baca</span>
                </div>

                <h1 style="font-size:32px;font-weight:800;color:var(--lp-primary);line-height:1.15;margin-top:16px;letter-spacing:-0.02em;">Panduan Memilih Excavator untuk Proyek Konstruksi 2026</h1>

                <div style="margin-top:32px;color:var(--lp-gray-600);font-size:16px;line-height:1.8;">
                    <p style="margin-bottom:16px;">Memilih excavator yang tepat adalah keputusan krusial yang memengaruhi produktivitas dan biaya operasional proyek konstruksi Anda. Dengan berbagai merek, tipe, dan spesifikasi yang tersedia, penting untuk memahami faktor-faktor utama sebelum melakukan investasi.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">1. Tentukan Kebutuhan Proyek</h2>
                    <p style="margin-bottom:16px;">Langkah pertama adalah mengidentifikasi jenis pekerjaan yang akan dilakukan. Apakah untuk penggalian, pemindahan material, pembongkaran, atau land clearing? Setiap aplikasi membutuhkan tipe excavator yang berbeda.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">2. Pertimbangkan Ukuran dan Kapasitas</h2>
                    <p style="margin-bottom:16px;">Excavator tersedia dalam berbagai kelas berat: mini (1-6 ton), medium (7-25 ton), dan heavy duty (25-100+ ton). Pilih ukuran yang sesuai dengan skala proyek Anda. Excavator yang terlalu besar akan boros bahan bakar, sementara yang terlalu kecil akan tidak efisien.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">3. Perhatikan Spesifikasi Mesin</h2>
                    <p style="margin-bottom:16px;">Tenaga mesin (HP), kapasitas bucket, jangkauan, dan kedalaman gali adalah spesifikasi kunci. Pastikan spesifikasi ini sesuai dengan kebutuhan teknis proyek Anda.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">4. Merek dan Ketersediaan Suku Cadang</h2>
                    <p style="margin-bottom:16px;">Pilih merek dengan jaringan layanan dan ketersediaan suku cadang yang luas di Indonesia. Merek seperti Komatsu, Caterpillar, dan Hitachi memiliki dukungan purna jual yang baik di seluruh nusantara.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">5. Efisiensi Bahan Bakar</h2>
                    <p style="margin-bottom:16px;">Biaya bahan bakar adalah komponen terbesar dalam biaya operasional. Pilih excavator dengan teknologi mesin terbaru yang menawarkan efisiensi bahan bakar lebih baik.</p>

                    <h2 style="font-size:22px;font-weight:700;color:var(--lp-primary);margin-top:40px;margin-bottom:12px;">6. Fitur Keselamatan dan Kenyamanan</h2>
                    <p style="margin-bottom:16px;">Kabin yang ergonomis, visibilitas 360°, kamera belakang, dan sistem keselamatan canggih akan meningkatkan produktivitas operator dan mengurangi risiko kecelakaan.</p>

                    <div style="background:var(--lp-primary-lighter);border-radius:var(--lp-radius-xl);padding:24px;border-left:4px solid var(--lp-primary);margin-top:32px;">
                        <p style="font-size:15px;font-weight:500;color:var(--lp-primary);margin:0;"><strong>Tips:</strong> Selalu lakukan uji coba (demo) sebelum membeli excavator. Banyak distributor menyediakan layanan demo gratis di lokasi proyek Anda.</p>
                    </div>

                    <p style="margin-top:24px;">Konsultasikan kebutuhan proyek Anda dengan tim sales profesional kami. Dengan pengalaman 15+ tahun, kami siap membantu Anda memilih solusi yang tepat.</p>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:40px;padding-top:24px;border-top:1px solid var(--lp-gray-200);flex-wrap:wrap;gap:16px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="font-size:14px;color:var(--lp-gray-500);">Bagikan:</span>
                        <a href="#" style="width:36px;height:36px;background:#1877f2;color:white;border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;font-size:14px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="width:36px;height:36px;background:#1da1f2;color:white;border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;font-size:14px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="width:36px;height:36px;background:#25d366;color:white;border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;font-size:14px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" style="width:36px;height:36px;background:#0a66c2;color:white;border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;font-size:14px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        <span style="font-size:14px;color:var(--lp-gray-500);">Tags:</span>
                        @php $tags = ['Excavator', 'Konstruksi', 'Alat Berat', 'Tips', 'Panduan']; @endphp
                        @foreach($tags as $tag)
                        <a href="#" style="padding:4px 14px;background:var(--lp-gray-100);color:var(--lp-gray-600);font-size:12px;border-radius:var(--lp-radius-full);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-gray-100)';this.style.color='var(--lp-gray-600)'">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <aside style="display:flex;flex-direction:column;gap:24px;">
                <div class="lp-feature-card" style="padding:24px;">
                    <h3 style="font-size:16px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;">Artikel Terkait</h3>
                    @php
                        $relatedArticles = [
                            ['title' => 'Inovasi Teknologi Mesin Pertanian Modern', 'date' => '10 Jun 2026', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=200'],
                            ['title' => 'Cara Merawat Mesin Industri Agar Awet', 'date' => '5 Jun 2026', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=200'],
                            ['title' => 'Tren Industri Alat Berat 2026', 'date' => '1 Jun 2026', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=200'],
                        ];
                    @endphp
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        @foreach($relatedArticles as $ra)
                        <a href="#" style="display:flex;align-items:flex-start;gap:12px;text-decoration:none;padding:8px;border-radius:var(--lp-radius-md);transition:all 0.2s;" onmouseover="this.style.background='var(--lp-gray-50)'" onmouseout="this.style.background='transparent'">
                            <img src="{{ $ra['image'] }}" alt="{{ $ra['title'] }}" style="width:60px;height:60px;border-radius:var(--lp-radius-md);object-fit:cover;flex-shrink:0;">
                            <div>
                                <p style="font-size:14px;font-weight:500;color:var(--lp-gray-800);margin:0;line-height:1.3;">{{ $ra['title'] }}</p>
                                <p style="font-size:12px;color:var(--lp-gray-400);margin-top:4px;">{{ $ra['date'] }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <div style="background:var(--lp-primary);border-radius:var(--lp-radius-xl);padding:28px;text-align:center;color:white;">
                    <i class="fas fa-headset" style="font-size:32px;margin-bottom:12px;display:block;"></i>
                    <h3 style="font-size:17px;font-weight:700;margin:0 0 8px;">Butuh Bantuan?</h3>
                    <p style="font-size:14px;color:rgba(255,255,255,0.7);margin:0 0 20px;">Konsultasikan kebutuhan mesin industri Anda dengan tim ahli kami</p>
                    <a href="{{ route('contact.index') }}" class="lp-btn lp-btn-primary" style="display:inline-flex;">
                        <i class="fas fa-headset"></i>
                        <span>Hubungi Kami</span>
                    </a>
                </div>

                <div class="lp-feature-card" style="padding:24px;">
                    <h3 style="font-size:16px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;">Kategori</h3>
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        @php $cats = ['Tips & Trik', 'Teknologi', 'Perawatan', 'Berita Industri', 'Studi Kasus', 'Produk Baru']; @endphp
                        @foreach($cats as $cat)
                        <a href="#" style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;font-size:14px;color:var(--lp-gray-600);text-decoration:none;transition:all 0.2s;border-bottom:1px solid var(--lp-gray-100);" onmouseover="this.style.color='var(--lp-primary)'" onmouseout="this.style.color='var(--lp-gray-600)'">
                            <span>{{ $cat }}</span>
                            <span style="font-size:12px;color:var(--lp-gray-400);">({{ rand(3, 12) }})</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
