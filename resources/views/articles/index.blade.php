@extends('layouts.landing')

@section('title', 'Blog & Artikel - Insight Industri Mesin')
@section('meta_description', 'Baca artikel terbaru seputar industri mesin, tips perawatan, teknologi, dan insight dari para ahli.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Artikel']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Blog & Artikel</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Insight, tips, dan informasi terbaru seputar industri mesin dan alat berat</p>
    </div>
</section>

<section class="lp-section-sm" style="background:var(--lp-white);border-bottom:1px solid var(--lp-gray-200);">
    <div class="lp-container">
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;">
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                @php $categories = ['Semua', 'Tips & Trik', 'Teknologi', 'Perawatan', 'Berita Industri', 'Studi Kasus', 'Produk Baru']; @endphp
                @foreach($categories as $cat)
                <button style="padding:8px 20px;font-size:14px;font-weight:500;border-radius:var(--lp-radius-full);border:none;cursor:pointer;transition:all 0.2s;{{ $loop->first ? 'background:var(--lp-primary);color:white;' : 'background:var(--lp-gray-50);color:var(--lp-gray-600);' }}" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='{{ $loop->first ? 'var(--lp-primary)' : 'var(--lp-gray-50)' }}';this.style.color='{{ $loop->first ? 'white' : 'var(--lp-gray-600)' }}'">{{ $cat }}</button>
                @endforeach
            </div>
            <div style="position:relative;">
                <i class="fas fa-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--lp-gray-400);font-size:14px;"></i>
                <input type="text" placeholder="Cari artikel..." class="lp-input" style="padding:10px 16px 10px 40px;font-size:14px;width:260px;">
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-grid-3">
            @php
                $articles = [
                    ['title' => 'Panduan Memilih Excavator untuk Proyek Konstruksi 2026', 'category' => 'Tips & Trik', 'date' => '15 Jun 2026', 'author' => 'Tim Teknis', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Pelajari faktor-faktor penting dalam memilih excavator yang tepat untuk kebutuhan proyek konstruksi Anda.', 'slug' => 'panduan-memilih-excavator'],
                    ['title' => 'Inovasi Teknologi Mesin Pertanian Modern di Indonesia', 'category' => 'Teknologi', 'date' => '10 Jun 2026', 'author' => 'Tim R&D', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400', 'excerpt' => 'Perkembangan teknologi mesin pertanian terkini yang meningkatkan efisiensi dan produktivitas.', 'slug' => 'inovasi-mesin-pertanian'],
                    ['title' => 'Cara Merawat Mesin Industri Agar Awet dan Tahan Lama', 'category' => 'Perawatan', 'date' => '5 Jun 2026', 'author' => 'Tim Layanan', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Tips perawatan rutin untuk memperpanjang umur mesin industri dan mengurangi biaya operasional.', 'slug' => 'merawat-mesin-industri'],
                    ['title' => 'Tren Industri Alat Berat 2026: Elektrifikasi dan Otomasi', 'category' => 'Berita Industri', 'date' => '1 Jun 2026', 'author' => 'Tim Analis', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400', 'excerpt' => 'Industri alat berat memasuki era baru dengan teknologi elektrifikasi dan sistem otomasi canggih.', 'slug' => 'tren-alat-berat-2026'],
                    ['title' => 'Studi Kasus: Optimalisasi Produksi dengan Mesin CNC', 'category' => 'Studi Kasus', 'date' => '28 Mei 2026', 'author' => 'Tim Teknis', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Bagaimana PT Manufaktur Indonesia meningkatkan produktivitas 40% dengan implementasi mesin CNC.', 'slug' => 'optimalisasi-cnc'],
                    ['title' => 'Perkenalan Produk Baru: Generator C15 500kVA', 'category' => 'Produk Baru', 'date' => '20 Mei 2026', 'author' => 'Tim Produk', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400', 'excerpt' => 'Generator terbaru dengan efisiensi bahan bakar tinggi dan emisi rendah untuk kebutuhan industri.', 'slug' => 'generator-c15-baru'],
                    ['title' => 'Tips Memilih Forklift yang Tepat untuk Gudang Anda', 'category' => 'Tips & Trik', 'date' => '15 Mei 2026', 'author' => 'Tim Sales', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Panduan lengkap memilih forklift sesuai kebutuhan kapasitas dan kondisi gudang Anda.', 'slug' => 'memilih-forklift'],
                    ['title' => 'Sistem Hidrolik pada Alat Berat: Cara Kerja & Perawatan', 'category' => 'Perawatan', 'date' => '10 Mei 2026', 'author' => 'Tim Teknis', 'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=400', 'excerpt' => 'Memahami sistem hidrolik dan cara merawatnya agar alat berat Anda selalu dalam kondisi prima.', 'slug' => 'sistem-hidrolik'],
                    ['title' => 'Masa Depan Industri 4.0 di Sektor Manufaktur Indonesia', 'category' => 'Berita Industri', 'date' => '5 Mei 2026', 'author' => 'Tim Analis', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400', 'excerpt' => 'Bagaimana revolusi industri 4.0 mengubah lanskap manufaktur di Indonesia.', 'slug' => 'industri-4-0-manufaktur'],
                ];
            @endphp
            @foreach($articles as $article)
                @include('partials.article-card', ['article' => $article])
            @endforeach
        </div>

        <nav style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:48px;">
            <span style="padding:10px 18px;font-size:14px;font-weight:600;background:var(--lp-primary);color:white;border-radius:var(--lp-radius-md);">1</span>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">2</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">3</a>
            <span style="padding:0 8px;color:var(--lp-gray-400);">...</span>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">8</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'"><i class="fas fa-chevron-right"></i></a>
        </nav>
    </div>
</section>
@endsection
