@extends('layouts.landing')

@section('title', 'PT Perusahaan Mesin Industri - Solusi Mesin Industri Terpercaya')
@section('meta_description', 'Distributor resmi mesin industri dan alat berat di Indonesia. 15+ tahun pengalaman, 500+ produk, 2000+ pelanggan. Solusi lengkap konstruksi, pertambangan, manufaktur.')

@section('content')
{{-- HERO --}}
<section class="lp-hero">
    <div class="lp-hero-bg"></div>
    <div class="lp-hero-pattern"></div>
    <div class="lp-hero-image" style="background-image:url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1920')"></div>
    <div class="lp-hero-overlay"></div>

    <div class="lp-hero-floating lp-hero-floating-1"></div>
    <div class="lp-hero-floating lp-hero-floating-2"></div>
    <div class="lp-hero-floating lp-hero-floating-3"></div>
    <div class="lp-hero-floating lp-hero-floating-4"></div>
    <div class="lp-hero-floating lp-hero-floating-5"></div>

    <div class="lp-hero-content">
        <div class="lp-hero-badge">
            <i class="fas fa-medal"></i>
            <span>Solusi Mesin Industri Terpercaya</span>
        </div>
        <h1 class="lp-hero-title">
            Mitra Terpercaya untuk
            <em>Solusi Mesin Industri</em>
            Anda
        </h1>
        <p class="lp-hero-desc">Menghadirkan mesin industri dan alat berat berkualitas global dengan layanan purna jual terbaik untuk mendukung kesuksesan bisnis Anda.</p>
        <div class="lp-hero-actions">
            <a href="{{ route('products.index') }}" class="lp-btn lp-btn-primary lp-btn-lg">
                <span>Lihat Produk</span>
                <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('contact.index') }}" class="lp-btn lp-btn-outline lp-btn-lg">
                <i class="fas fa-headset"></i>
                <span>Hubungi Sales</span>
            </a>
            <a href="{{ route('downloads.index') }}" class="lp-btn lp-btn-ghost lp-btn-lg">
                <i class="fas fa-download"></i>
                <span>Download Katalog</span>
            </a>
        </div>
    </div>

    <div class="lp-hero-scroll">
        <div class="lp-hero-scroll-inner">
            <div class="lp-hero-scroll-dot"></div>
        </div>
    </div>
</section>

{{-- TRUST INDICATORS --}}
<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        @php
            $stats = [
                ['value' => '15+', 'label' => 'Tahun Pengalaman', 'icon' => 'history'],
                ['value' => '500+', 'label' => 'Produk Tersedia', 'icon' => 'box'],
                ['value' => '2000+', 'label' => 'Customer Puas', 'icon' => 'users'],
                ['value' => '1000+', 'label' => 'Proyek Selesai', 'icon' => 'check-double'],
                ['value' => '50+', 'label' => 'Teknisi Ahli', 'icon' => 'user-cog'],
                ['value' => '100+', 'label' => 'Kota Terjangkau', 'icon' => 'city'],
            ];
        @endphp
        <div class="lp-grid-6 lp-stagger">
            @foreach($stats as $stat)
            <div class="lp-stat-card">
                <div class="lp-stat-icon">
                    <i class="fas fa-{{ $stat['icon'] }}"></i>
                </div>
                <div class="lp-stat-value">{{ $stat['value'] }}</div>
                <div class="lp-stat-label">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PRODUCT CATEGORIES --}}
<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Kategori Produk</span>
            <h2 class="lp-title">Solusi Mesin Industri Lengkap</h2>
            <p class="lp-subtitle">Kami menyediakan berbagai kategori mesin industri untuk memenuhi kebutuhan bisnis Anda</p>
        </div>

        @php
            $categories = [
                ['icon' => 'warehouse', 'name' => 'Mesin Konstruksi', 'count' => '45+'],
                ['icon' => 'tractor', 'name' => 'Mesin Pertanian', 'count' => '38+'],
                ['icon' => 'industry', 'name' => 'Mesin Manufaktur', 'count' => '52+'],
                ['icon' => 'bolt', 'name' => 'Mesin Energi', 'count' => '28+'],
                ['icon' => 'water', 'name' => 'Mesin Pengolahan', 'count' => '34+'],
                ['icon' => 'microchip', 'name' => 'Sistem Otomasi', 'count' => '41+'],
                ['icon' => 'truck', 'name' => 'Alat Berat', 'count' => '56+'],
                ['icon' => 'oil-well', 'name' => 'Mesin Pertambangan', 'count' => '33+'],
                ['icon' => 'snowflake', 'name' => 'Mesin Pendingin', 'count' => '22+'],
                ['icon' => 'fire', 'name' => 'Mesin Boiler', 'count' => '18+'],
                ['icon' => 'weight-hanging', 'name' => 'Alat Ukur', 'count' => '27+'],
                ['icon' => 'tools', 'name' => 'Suku Cadang', 'count' => '200+'],
            ];
        @endphp

        <div class="lp-grid-4 lp-stagger">
            @foreach($categories as $cat)
            <a href="{{ route('products.index') }}?category={{ Str::slug($cat['name']) }}" class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-{{ $cat['icon'] }}"></i>
                </div>
                <h3 class="lp-feature-title">{{ $cat['name'] }}</h3>
                <p class="lp-feature-desc">{{ $cat['count'] }} Produk</p>
                <div style="margin-top:16px;display:flex;align-items:center;gap:6px;font-size:14px;font-weight:600;color:var(--lp-secondary);">
                    <span>Lihat Produk</span>
                    <i class="fas fa-arrow-right" style="font-size:12px;"></i>
                </div>
            </a>
            @endforeach
        </div>

        <div class="lp-text-center lp-mt-10">
            <a href="{{ route('products.index') }}" class="lp-btn lp-btn-dark lp-btn-lg">
                <span>Lihat Semua Produk</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- FEATURED PRODUCTS --}}
<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-flex-between lp-mb-8" style="align-items:flex-end;">
            <div>
                <span class="lp-label">Produk Unggulan</span>
                <h2 class="lp-title lp-mb-0">Produk Paling Diminati</h2>
            </div>
            <a href="{{ route('products.index') }}" class="lp-card-link" style="display:none;" class="md:inline-flex">
                <span>Lihat Semua</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="lp-grid-4 lp-stagger">
            @php
                $products = [
                    ['name' => 'Excavator EC480D', 'category' => 'Mesin Konstruksi', 'specs' => '48 Ton | 345 HP', 'badge' => 'Best Seller', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400'],
                    ['name' => 'Bulldozer D6R2', 'category' => 'Alat Berat', 'specs' => '30 Ton | 265 HP', 'badge' => 'Promo', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400'],
                    ['name' => 'CNC Milling VF-2', 'category' => 'Mesin Manufaktur', 'specs' => 'XYZ: 762x406x508 mm', 'badge' => 'New', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400'],
                    ['name' => 'Generator C15 500kVA', 'category' => 'Mesin Energi', 'specs' => '500 kVA | Diesel', 'badge' => 'Premium', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400'],
                ];
            @endphp
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>

{{-- INDUSTRY SOLUTIONS --}}
<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Solusi Industri</span>
            <h2 class="lp-title">Solusi Berdasarkan Industri</h2>
            <p class="lp-subtitle">Kami menyediakan solusi khusus untuk berbagai sektor industri</p>
        </div>

        @php
            $industries = [
                ['icon' => 'building', 'name' => 'Konstruksi & Infrastruktur', 'desc' => 'Alat berat untuk proyek konstruksi jalan, jembatan, gedung'],
                ['icon' => 'hard-hat', 'name' => 'Pertambangan & Mineral', 'desc' => 'Solusi pertambangan batubara, mineral, dan logam'],
                ['icon' => 'leaf', 'name' => 'Agrikultur & Perkebunan', 'desc' => 'Traktor dan mesin pertanian modern untuk hasil maksimal'],
                ['icon' => 'industry', 'name' => 'Manufaktur & Produksi', 'desc' => 'Otomasi lini produksi dengan mesin CNC dan robotik'],
                ['icon' => 'oil-can', 'name' => 'Minyak & Gas', 'desc' => 'Perlengkapan eksplorasi dan produksi migas'],
                ['icon' => 'ship', 'name' => 'Kelautan & Perkapalan', 'desc' => 'Mesin kapal dan peralatan maritim'],
                ['icon' => 'warehouse', 'name' => 'Logistik & Pergudangan', 'desc' => 'Forklift, conveyor, dan sistem penyimpanan'],
                ['icon' => 'recycle', 'name' => 'Pengolahan Limbah', 'desc' => 'Mesin daur ulang dan pengolahan air limbah'],
            ];
        @endphp

        <div class="lp-grid-4 lp-stagger">
            @foreach($industries as $ind)
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-{{ $ind['icon'] }}"></i>
                </div>
                <h3 class="lp-feature-title">{{ $ind['name'] }}</h3>
                <p class="lp-feature-desc">{{ $ind['desc'] }}</p>
                <a href="#" class="lp-card-link lp-mt-4">
                    <span>Pelajari</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- WHY CHOOSE US --}}
<section class="lp-section lp-dark-section lp-fade-in">
    <div class="lp-blob" style="width:400px;height:400px;background:rgba(220,107,31,0.08);top:-100px;right:-100px;"></div>
    <div class="lp-blob" style="width:300px;height:300px;background:rgba(15,43,74,0.15);bottom:-80px;left:-80px;"></div>

    <div class="lp-container" style="position:relative;z-index:1;">
        <div class="lp-grid-2" style="align-items:center;">
            <div class="lp-fade-in-left" style="position:relative;">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600" alt="Tim Profesional" style="border-radius:var(--lp-radius-2xl);width:100%;box-shadow:var(--lp-shadow-2xl);">
                <div class="lp-glass" style="position:absolute;bottom:-24px;right:-24px;padding:20px 28px;border-radius:var(--lp-radius-xl);display:none;" class="md:block">
                    <div style="font-size:32px;font-weight:800;color:white;">15+</div>
                    <div style="color:rgba(255,255,255,0.7);font-size:14px;">Tahun Pengalaman</div>
                </div>
            </div>
            <div class="lp-fade-in-right">
                <span class="lp-label">Mengapa Memilih Kami</span>
                <h2 class="lp-title" style="color:white;">Mitra Terbaik untuk Pertumbuhan Bisnis Anda</h2>
                <div class="lp-section-divider-left"></div>
                @php
                    $benefits = [
                        ['icon' => 'medal', 'title' => 'Kualitas Terjamin', 'desc' => 'Produk bersertifikasi ISO dan garansi resmi dari pabrikan'],
                        ['icon' => 'headset', 'title' => 'Dukungan Teknis 24/7', 'desc' => 'Tim teknisi siap membantu kapan pun Anda butuhkan'],
                        ['icon' => 'boxes', 'title' => 'Stok Melimpah', 'desc' => 'Ribuan produk siap kirim dari gudang di seluruh Indonesia'],
                        ['icon' => 'truck-fast', 'title' => 'Pengiriman Cepat', 'desc' => 'Pengiriman tepat waktu ke seluruh Indonesia dengan armada sendiri'],
                        ['icon' => 'shield-alt', 'title' => 'Garansi Resmi', 'desc' => 'Garansi mesin hingga 5 tahun dan layanan purna jual'],
                        ['icon' => 'tags', 'title' => 'Harga Kompetitif', 'desc' => 'Harga distributor langsung dari pabrikan tanpa perantara'],
                    ];
                @endphp
                <div style="display:flex;flex-direction:column;gap:20px;">
                    @foreach($benefits as $b)
                    <div style="display:flex;align-items:flex-start;gap:16px;">
                        <div style="width:44px;height:44px;background:rgba(220,107,31,0.12);border-radius:var(--lp-radius-lg);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-{{ $b['icon'] }}" style="color:var(--lp-secondary-light);"></i>
                        </div>
                        <div>
                            <h3 style="font-size:17px;font-weight:700;color:white;margin:0 0 4px;">{{ $b['title'] }}</h3>
                            <p style="font-size:14px;color:rgba(255,255,255,0.5);margin:0;">{{ $b['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Testimonial</span>
            <h2 class="lp-title">Apa Kata Klien Kami</h2>
        </div>

        @php
            $testimonials = [
                ['name' => 'Budi Santoso', 'company' => 'PT Konstruksi Maju', 'photo' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=0f2b4a&color=fff&size=80', 'text' => 'Kami sangat puas dengan layanan dan kualitas produk dari Perusahaan Mesin. Excavator yang kami beli sangat handal untuk proyek infrastruktur di Kalimantan. Purna jualnya juga sangat responsif.', 'rating' => 5],
                ['name' => 'Siti Rahmawati', 'company' => 'CV Agro Sejahtera', 'photo' => 'https://ui-avatars.com/api/?name=Siti+Rahmawati&background=dc6b1f&color=fff&size=80', 'text' => 'Traktor yang kami beli sangat membantu produktivitas perkebunan kami. Konsultasi dari tim sales sangat membantu dalam memilih mesin yang tepat. Highly recommended!', 'rating' => 5],
                ['name' => 'Andi Wijaya', 'company' => 'PT Manufaktur Indonesia', 'photo' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&background=10b981&color=fff&size=80', 'text' => 'Mesin CNC yang kami impor melalui Perusahaan Mesin berkualitas tinggi dan sesuai standar. Proses pengiriman dan instalasi sangat profesional. Terima kasih!', 'rating' => 4],
            ];
        @endphp

        <div class="lp-grid-3 lp-stagger">
            @foreach($testimonials as $t)
            <div class="lp-testimonial-card">
                <div class="lp-testimonial-stars">
                    @for($i = 0; $i < 5; $i++)
                        <i class="{{ $i < $t['rating'] ? 'fas fa-star' : 'far fa-star' }}" style="color:{{ $i < $t['rating'] ? '#f59e0b' : '#d1d5db' }};"></i>
                    @endfor
                </div>
                <p class="lp-testimonial-text">"{{ $t['text'] }}"</p>
                <div class="lp-testimonial-author">
                    <img src="{{ $t['photo'] }}" alt="{{ $t['name'] }}" class="lp-testimonial-avatar">
                    <div>
                        <div class="lp-testimonial-name">{{ $t['name'] }}</div>
                        <div class="lp-testimonial-company">{{ $t['company'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BLOG --}}
<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-flex-between lp-mb-8" style="align-items:flex-end;">
            <div>
                <span class="lp-label">Artikel & Insight</span>
                <h2 class="lp-title lp-mb-0">Artikel & Insight Terbaru</h2>
            </div>
            <a href="{{ route('articles.index') }}" class="lp-card-link" style="display:none;" class="md:inline-flex">
                <span>Lihat Semua</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="lp-grid-3 lp-stagger">
            @php
                $articles = [
                    ['title' => 'Panduan Memilih Excavator untuk Proyek Konstruksi 2026', 'category' => 'Tips & Trik', 'date' => '15 Jun 2026', 'author' => 'Tim Teknis', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Pelajari faktor-faktor penting dalam memilih excavator yang tepat untuk kebutuhan proyek konstruksi Anda.'],
                    ['title' => 'Inovasi Teknologi Mesin Pertanian Modern di Indonesia', 'category' => 'Teknologi', 'date' => '10 Jun 2026', 'author' => 'Tim R&D', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400', 'excerpt' => 'Perkembangan teknologi mesin pertanian terkini yang meningkatkan efisiensi dan produktivitas.'],
                    ['title' => 'Cara Merawat Mesin Industri Agar Awet dan Tahan Lama', 'category' => 'Perawatan', 'date' => '5 Jun 2026', 'author' => 'Tim Layanan', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Tips perawatan rutin untuk memperpanjang umur mesin industri dan mengurangi biaya operasional.'],
                ];
            @endphp
            @foreach($articles as $article)
                @include('partials.article-card', ['article' => $article])
            @endforeach
        </div>
    </div>
</section>

{{-- NEWSLETTER --}}
<section class="lp-section lp-dark-section lp-fade-in">
    <div class="lp-blob" style="width:300px;height:300px;background:rgba(220,107,31,0.08);top:-80px;right:-80px;"></div>
    <div class="lp-container" style="position:relative;z-index:1;">
        <div style="max-width:600px;margin:0 auto;text-align:center;">
            <h2 class="lp-title" style="color:white;font-size:32px;">Dapatkan Update Terbaru</h2>
            <p class="lp-subtitle" style="color:rgba(255,255,255,0.5);margin-bottom:32px;">Berlangganan newsletter kami untuk mendapatkan informasi produk terbaru, promo, dan tips industri</p>
            <form>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div style="display:flex;gap:12px;">
                        <input type="text" placeholder="Nama Anda" class="lp-input lp-input-dark" style="flex:1;">
                        <input type="email" placeholder="Email Anda" class="lp-input lp-input-dark" style="flex:1;">
                    </div>
                    <button type="submit" class="lp-btn lp-btn-primary lp-btn-lg lp-btn-block" style="margin-top:4px;">
                        <i class="fas fa-paper-plane"></i>
                        <span>Berlangganan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- CLIENTS LOGO --}}
<section class="lp-section-sm lp-fade-in">
    <div class="lp-container lp-text-center lp-mb-8">
        <span class="lp-label">Dipercaya Oleh</span>
    </div>
    <div style="overflow:hidden;">
        <div class="animate-scroll" style="display:flex;gap:32px;width:max-content;">
            @php
                $logos = ['KOMATSU', 'CATERPILLAR', 'HITACHI', 'VOLVO', 'DOOSAN', 'HYUNDAI', 'LIEBHERR', 'SANY', 'XCMG', 'SUMITOMO', 'KUBOTA', 'YANMAR'];
            @endphp
            @for($i = 0; $i < 3; $i++)
                @foreach($logos as $logo)
                <div style="flex-shrink:0;padding:16px 32px;background:var(--lp-gray-50);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-lg);min-width:160px;text-align:center;">
                    <span style="font-size:16px;font-weight:700;color:var(--lp-gray-300);letter-spacing:0.08em;">{{ $logo }}</span>
                </div>
                @endforeach
            @endfor
        </div>
    </div>
</section>
@endsection
