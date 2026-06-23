@extends('layouts.landing')

@section('title', 'Testimonial - Apa Kata Klien Kami')
@section('meta_description', 'Baca testimonial dari pelanggan kami yang telah merasakan kualitas produk dan layanan Perusahaan Mesin Industri.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Testimonial']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Testimonial</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Apa kata klien kami tentang produk dan layanan Perusahaan Mesin Industri</p>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-grid-3 lp-stagger">
            @php
                $testimonials = [
                    ['name' => 'Budi Santoso', 'company' => 'PT Konstruksi Maju', 'position' => 'Project Manager', 'text' => 'Kami sangat puas dengan layanan dan kualitas produk dari Perusahaan Mesin. Excavator yang kami beli sangat handal untuk proyek infrastruktur di Kalimantan. Purna jualnya juga sangat responsif.', 'rating' => 5],
                    ['name' => 'Siti Rahmawati', 'company' => 'CV Agro Sejahtera', 'position' => 'Direktur', 'text' => 'Traktor yang kami beli sangat membantu produktivitas perkebunan kami. Konsultasi dari tim sales sangat membantu dalam memilih mesin yang tepat.', 'rating' => 5],
                    ['name' => 'Andi Wijaya', 'company' => 'PT Manufaktur Indonesia', 'position' => 'Production Manager', 'text' => 'Mesin CNC yang kami impor berkualitas tinggi dan sesuai standar. Proses pengiriman dan instalasi sangat profesional.', 'rating' => 4],
                    ['name' => 'Dian Permata Sari', 'company' => 'PT Energi Nusantara', 'position' => 'Technical Director', 'text' => 'Generator yang kami beli sangat handal dan efisien. Tim teknis sangat membantu dalam proses instalasi dan commissioning.', 'rating' => 5],
                    ['name' => 'Hendra Gunawan', 'company' => 'CV Bangun Persada', 'position' => 'Owner', 'text' => 'Sudah 5 tahun menjadi pelanggan setia. Pelayanan dan produk selalu konsisten berkualitas. Recommended!', 'rating' => 5],
                    ['name' => 'Fitriani Nurul', 'company' => 'PT Agrobisnis Sejahtera', 'position' => 'Operational Manager', 'text' => 'Suku cadang selalu tersedia dan pengiriman cepat. Sangat membantu operasional perusahaan kami.', 'rating' => 4],
                    ['name' => 'Rudi Hermawan', 'company' => 'PT Tambang Mineral', 'position' => 'Site Manager', 'text' => 'Alat berat dari Perusahaan Mesin sangat tangguh untuk kondisi tambang yang berat. Pelayanan purna jual excellent!', 'rating' => 5],
                    ['name' => 'Lisa Andriani', 'company' => 'CV Pangan Makmur', 'position' => 'Direktur Utama', 'text' => 'Mesin pengolahan yang kami beli sangat efisien dan mudah dioperasikan. Terima kasih atas bimbingan teknisnya.', 'rating' => 5],
                    ['name' => 'Agus Pratama', 'company' => 'PT Logistik Indonesia', 'position' => 'Warehouse Manager', 'text' => 'Forklift yang kami beli sangat handal untuk operasional gudang. Servis berkala selalu tepat waktu.', 'rating' => 4],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="lp-testimonial-card">
                <div class="lp-testimonial-stars">
                    @for($i = 0; $i < 5; $i++)
                        <i class="{{ $i < $t['rating'] ? 'fas fa-star' : 'far fa-star' }}" style="color:{{ $i < $t['rating'] ? '#f59e0b' : '#d1d5db' }};"></i>
                    @endfor
                </div>
                <p class="lp-testimonial-text">"{{ $t['text'] }}"</p>
                <div class="lp-testimonial-author">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&background=0f2b4a&color=fff&size=80" alt="{{ $t['name'] }}" class="lp-testimonial-avatar">
                    <div>
                        <div class="lp-testimonial-name">{{ $t['name'] }}</div>
                        <div class="lp-testimonial-company">{{ $t['position'] }}, {{ $t['company'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <nav style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:48px;">
            <span style="padding:10px 18px;font-size:14px;font-weight:600;background:var(--lp-primary);color:white;border-radius:var(--lp-radius-md);">1</span>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">2</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">3</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'"><i class="fas fa-chevron-right"></i></a>
        </nav>
    </div>
</section>

<section class="lp-section" style="background:var(--lp-primary);">
    <div class="lp-container lp-text-center">
        <h2 class="lp-title" style="color:white;font-size:32px;margin-bottom:12px;">Jadilah Pelanggan Kami Selanjutnya</h2>
        <p style="color:rgba(255,255,255,0.7);font-size:17px;margin-bottom:32px;">Dapatkan produk mesin industri berkualitas dengan layanan terbaik dari tim profesional kami</p>
        <a href="{{ route('contact.index') }}" class="lp-btn lp-btn-primary lp-btn-lg">
            <i class="fas fa-headset"></i>
            <span>Hubungi Kami Sekarang</span>
        </a>
    </div>
</section>
@endsection
