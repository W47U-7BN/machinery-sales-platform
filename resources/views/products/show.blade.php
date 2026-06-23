@extends('layouts.landing')

@section('title', 'Excavator EC480D - Mesin Konstruksi')
@section('meta_description', 'Excavator EC480D 48 Ton dengan 345 HP. Mesin konstruksi handal untuk proyek besar. Dapatkan penawaran terbaik.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 60px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['url' => route('products.index'), 'label' => 'Produk'], ['label' => 'Excavator EC480D']]])
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding-top:40px;">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;">
            <div>
                <div style="border-radius:var(--lp-radius-2xl);overflow:hidden;box-shadow:var(--lp-shadow-xl);background:var(--lp-gray-100);">
                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=700" alt="Excavator EC480D" style="width:100%;display:block;">
                </div>
                <div style="display:flex;gap:12px;margin-top:16px;">
                    <div style="flex:1;border-radius:var(--lp-radius-lg);overflow:hidden;border:2px solid var(--lp-primary);cursor:pointer;">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=200" alt="" style="width:100%;display:block;">
                    </div>
                    <div style="flex:1;border-radius:var(--lp-radius-lg);overflow:hidden;border:2px solid transparent;cursor:pointer;opacity:0.5;">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=200" alt="" style="width:100%;display:block;">
                    </div>
                    <div style="flex:1;border-radius:var(--lp-radius-lg);overflow:hidden;border:2px solid transparent;cursor:pointer;opacity:0.5;">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=200" alt="" style="width:100%;display:block;">
                    </div>
                    <div style="flex:1;border-radius:var(--lp-radius-lg);overflow:hidden;border:2px solid transparent;cursor:pointer;opacity:0.5;">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=200" alt="" style="width:100%;display:block;">
                    </div>
                </div>
            </div>

            <div>
                <span class="lp-label">Mesin Konstruksi</span>
                <h1 style="font-size:32px;font-weight:800;color:var(--lp-primary);margin:8px 0;line-height:1.15;letter-spacing:-0.02em;">Excavator EC480D</h1>
                <div style="display:flex;align-items:center;gap:12px;margin:12px 0 20px;">
                    <span class="lp-badge lp-badge-secondary">Best Seller</span>
                    <span style="font-size:14px;color:var(--lp-gray-500);">SKU: EXC-480D-2026</span>
                </div>
                <p style="font-size:16px;color:var(--lp-gray-600);line-height:1.7;margin-bottom:24px;">Excavator heavy duty 48 ton dengan tenaga 345 HP. Cocok untuk proyek konstruksi skala besar, pertambangan, dan infrastruktur. Dilengkapi teknologi terbaru untuk efisiensi bahan bakar dan produktivitas maksimal.</p>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px;">
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Berat Operasi</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-primary);">48 Ton</span>
                    </div>
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Tenaga Mesin</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-primary);">345 HP</span>
                    </div>
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Kapasitas Bucket</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-primary);">2.8 m&sup3;</span>
                    </div>
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Tahun Produksi</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-primary);">2026</span>
                    </div>
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Garansi</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-primary);">3 Tahun</span>
                    </div>
                    <div style="padding:12px 16px;background:var(--lp-gray-50);border-radius:var(--lp-radius-md);">
                        <span style="font-size:12px;color:var(--lp-gray-500);display:block;">Kondisi</span>
                        <span style="font-size:16px;font-weight:700;color:var(--lp-success);">Baru</span>
                    </div>
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <a href="{{ route('penawaran') }}?product=excavator-ec480d" class="lp-btn lp-btn-primary lp-btn-lg" style="flex:1;">
                        <i class="fas fa-file-invoice"></i>
                        <span>Minta Penawaran</span>
                    </a>
                    <a href="https://wa.me/6281234567890?text={{ urlencode('Saya tertarik dengan Excavator EC480D') }}" target="_blank" style="display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:14px 28px;background:#25d366;color:white;font-weight:600;border:none;border-radius:var(--lp-radius-lg);font-size:15px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='#1da851';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#25d366';this.style.transform='none'">
                        <i class="fab fa-whatsapp"></i>
                        <span>Chat Sales</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Spesifikasi</span>
            <h2 class="lp-title">Spesifikasi Teknis</h2>
        </div>
        <div style="max-width:800px;margin:0 auto;">
            <table style="width:100%;border-collapse:collapse;">
                @php
                    $specs = [
                        ['label' => 'Berat Operasi', 'value' => '48,000 kg'],
                        ['label' => 'Tenaga Mesin', 'value' => '345 HP @ 1,800 rpm'],
                        ['label' => 'Kapasitas Bucket', 'value' => '2.8 m&sup3; (SAE)'],
                        ['label' => 'Kedalaman Gali Maks', 'value' => '7,850 mm'],
                        ['label' => 'Jangkauan Maks', 'value' => '11,200 mm'],
                        ['label' => 'Tinggi Pembuangan', 'value' => '7,200 mm'],
                        ['label' => 'Travel Speed', 'value' => '5.5 / 3.2 km/jam'],
                        ['label' => 'Swing Speed', 'value' => '9.0 rpm'],
                        ['label' => 'Ground Pressure', 'value' => '78 kPa'],
                        ['label' => 'Fuel Tank', 'value' => '650 L'],
                        ['label' => 'Engine Model', 'value' => 'Cummins QSM11'],
                        ['label' => 'Standar Emisi', 'value' => 'Tier 4 Final'],
                    ];
                @endphp
                @foreach($specs as $i => $spec)
                <tr style="border-bottom:1px solid var(--lp-gray-200);">
                    <td style="padding:12px 16px;font-size:15px;color:var(--lp-gray-600);background:{{ $i % 2 === 0 ? 'var(--lp-white)' : 'var(--lp-gray-50)' }};">{{ $spec['label'] }}</td>
                    <td style="padding:12px 16px;font-size:15px;font-weight:600;color:var(--lp-gray-800);background:{{ $i % 2 === 0 ? 'var(--lp-white)' : 'var(--lp-gray-50)' }};">{{ $spec['value'] }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div class="lp-section-title">
            <span class="lp-label">Layanan</span>
            <h2 class="lp-title">Layanan Lengkap untuk Produk Ini</h2>
        </div>
        <div class="lp-grid-4 lp-stagger">
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="lp-feature-title">Pengiriman</h3>
                <p class="lp-feature-desc">Pengiriman ke seluruh Indonesia dengan armada khusus alat berat</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-tools"></i>
                </div>
                <h3 class="lp-feature-title">Instalasi</h3>
                <p class="lp-feature-desc">Layanan instalasi dan commissioning oleh teknisi bersertifikat</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="lp-feature-title">Garansi</h3>
                <p class="lp-feature-desc">Garansi resmi 3 tahun dan layanan purna jual 24/7</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:var(--lp-primary-lighter);color:var(--lp-primary);">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="lp-feature-title">Pelatihan</h3>
                <p class="lp-feature-desc">Pelatihan operator dan perawatan dasar untuk tim Anda</p>
            </div>
        </div>
    </div>
</section>
@endsection
