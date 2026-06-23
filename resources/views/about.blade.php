@extends('layouts.landing')

@section('title', 'Tentang Kami - Perusahaan Mesin Industri')
@section('meta_description', 'Pelajari lebih lanjut tentang Perusahaan Mesin Industri, sejarah, visi misi, tim, dan sertifikasi kami.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Tentang Kami']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Tentang Kami</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Mitra terpercaya dalam solusi mesin industri sejak 2010</p>
    </div>
</section>

<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-grid-2" style="align-items:center;">
            <div>
                <span class="lp-label">Sejarah Kami</span>
                <h2 class="lp-title">Perjalanan 15+ Tahun Menjadi Pemimpin Industri</h2>
                <div class="lp-section-divider-left"></div>
                <p style="font-size:16px;color:var(--lp-gray-600);line-height:1.7;margin-bottom:16px;">Berdiri sejak 2010, PT Perusahaan Mesin Industri telah berkembang menjadi distributor terkemuka mesin industri dan alat berat di Indonesia. Kami memulai perjalanan sebagai supplier kecil di Jakarta, dan kini melayani ribuan pelanggan di seluruh nusantara.</p>
                <p style="font-size:16px;color:var(--lp-gray-600);line-height:1.7;">Komitmen kami terhadap kualitas, layanan purna jual, dan kepuasan pelanggan telah menjadikan kami mitra terpercaya bagi perusahaan-perusahaan terbesar di Indonesia.</p>
            </div>
            <div style="position:relative;">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600" alt="Sejarah Perusahaan" style="border-radius:var(--lp-radius-2xl);width:100%;box-shadow:var(--lp-shadow-xl);">
                <div style="position:absolute;bottom:-24px;left:-24px;background:var(--lp-primary);border-radius:var(--lp-radius-xl);padding:20px 28px;box-shadow:var(--lp-shadow-xl);display:none;" class="md:block">
                    <div style="font-size:32px;font-weight:800;color:white;">2010</div>
                    <div style="color:rgba(255,255,255,0.7);font-size:14px;">Tahun Berdiri</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-grid-2">
            <div class="lp-feature-card" style="padding:40px 32px;">
                <div style="width:56px;height:56px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-lg);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <i class="fas fa-bullseye" style="color:var(--lp-secondary);font-size:24px;"></i>
                </div>
                <h3 class="lp-feature-title" style="font-size:22px;">Visi</h3>
                <p class="lp-feature-desc" style="font-size:15px;">Menjadi perusahaan solusi mesin industri terdepan di Asia Tenggara yang dikenal akan inovasi, kualitas, dan layanan terbaik.</p>
            </div>
            <div class="lp-feature-card" style="padding:40px 32px;">
                <div style="width:56px;height:56px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-lg);display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                    <i class="fas fa-eye" style="color:var(--lp-secondary);font-size:24px;"></i>
                </div>
                <h3 class="lp-feature-title" style="font-size:22px;">Misi</h3>
                <ul style="list-style:none;padding:0;margin:0;">
                    <li style="display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;font-size:15px;color:var(--lp-gray-600);"><i class="fas fa-check" style="color:var(--lp-accent);margin-top:3px;"></i><span>Menyediakan produk mesin industri berkualitas global</span></li>
                    <li style="display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;font-size:15px;color:var(--lp-gray-600);"><i class="fas fa-check" style="color:var(--lp-accent);margin-top:3px;"></i><span>Memberikan layanan purna jual terbaik di kelasnya</span></li>
                    <li style="display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;font-size:15px;color:var(--lp-gray-600);"><i class="fas fa-check" style="color:var(--lp-accent);margin-top:3px;"></i><span>Mengembangkan solusi inovatif untuk industri Indonesia</span></li>
                    <li style="display:flex;align-items:flex-start;gap:8px;font-size:15px;color:var(--lp-gray-600);"><i class="fas fa-check" style="color:var(--lp-accent);margin-top:3px;"></i><span>Membangun kemitraan jangka panjang dengan pelanggan</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Tim Kami</span>
            <h2 class="lp-title">Kepemimpinan Perusahaan</h2>
        </div>
        <div class="lp-grid-4 lp-stagger">
            @php
                $team = [
                    ['name' => 'Ir. H. Ahmad Syahputra', 'role' => 'Presiden Direktur', 'photo' => 'https://ui-avatars.com/api/?name=Ahmad+Syahputra&background=0f2b4a&color=fff&size=200'],
                    ['name' => 'Dr. Rina Wijayanti, MBA', 'role' => 'Direktur Operasional', 'photo' => 'https://ui-avatars.com/api/?name=Rina+Wijayanti&background=dc6b1f&color=fff&size=200'],
                    ['name' => 'Bambang Setiawan, ST', 'role' => 'Direktur Teknis', 'photo' => 'https://ui-avatars.com/api/?name=Bambang+Setiawan&background=10b981&color=fff&size=200'],
                    ['name' => 'Dewi Lestari, SE', 'role' => 'Direktur Keuangan', 'photo' => 'https://ui-avatars.com/api/?name=Dewi+Lestari&background=0a1628&color=fff&size=200'],
                ];
            @endphp
            @foreach($team as $member)
            <div class="lp-text-center lp-fade-in">
                <div style="width:160px;height:160px;margin:0 auto 16px;border-radius:var(--lp-radius-2xl);overflow:hidden;border:3px solid var(--lp-gray-100);transition:border-color 0.3s;" onmouseover="this.style.borderColor='var(--lp-primary)'" onmouseout="this.style.borderColor='var(--lp-gray-100)'">
                    <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                <h3 style="font-size:16px;font-weight:600;color:var(--lp-gray-800);margin:0 0 4px;">{{ $member['name'] }}</h3>
                <p style="font-size:14px;color:var(--lp-gray-500);margin:0;">{{ $member['role'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Sertifikasi</span>
            <h2 class="lp-title">Sertifikasi & Pengakuan</h2>
        </div>
        <div class="lp-grid-4 lp-stagger">
            @php
                $certs = [
                    ['icon' => 'certificate', 'name' => 'ISO 9001:2015', 'desc' => 'Sistem Manajemen Mutu'],
                    ['icon' => 'certificate', 'name' => 'ISO 14001:2015', 'desc' => 'Sistem Manajemen Lingkungan'],
                    ['icon' => 'certificate', 'name' => 'OHSAS 18001', 'desc' => 'Keselamatan & Kesehatan Kerja'],
                    ['icon' => 'certificate', 'name' => 'SNI', 'desc' => 'Standar Nasional Indonesia'],
                ];
            @endphp
            @foreach($certs as $cert)
            <div class="lp-stat-card">
                <i class="fas fa-{{ $cert['icon'] }}" style="font-size:36px;color:var(--lp-secondary);margin-bottom:12px;display:block;"></i>
                <h3 style="font-size:16px;font-weight:600;color:var(--lp-gray-800);margin:0 0 4px;">{{ $cert['name'] }}</h3>
                <p style="font-size:14px;color:var(--lp-gray-500);margin:0;">{{ $cert['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Mitra</span>
            <h2 class="lp-title">Mitra Strategis</h2>
        </div>
        <div class="lp-grid-6 lp-stagger">
            @php $partners = ['KOMATSU', 'CATERPILLAR', 'HITACHI', 'VOLVO', 'DOOSAN', 'HYUNDAI', 'LIEBHERR', 'SANY', 'XCMG', 'KUBOTA', 'YANMAR', 'SUMITOMO']; @endphp
            @foreach($partners as $partner)
            <div class="lp-stat-card" style="padding:20px 16px;">
                <span style="font-size:13px;font-weight:700;color:var(--lp-gray-400);letter-spacing:0.08em;">{{ $partner }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
