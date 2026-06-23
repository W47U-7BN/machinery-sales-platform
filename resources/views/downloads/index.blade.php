@extends('layouts.landing')

@section('title', 'Download Center - Katalog & Brosur')
@section('meta_description', 'Download katalog produk, brosur, manual book, dan dokumen lainnya secara gratis.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Download Center']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Download Center</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Unduh katalog produk, brosur, manual, dan dokumen teknis lainnya</p>
    </div>
</section>

<section class="lp-section lp-gray-section lp-fade-in">
    <div class="lp-container">
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:32px;">
            @php $cats = ['Semua', 'Katalog Produk', 'Brosur', 'Manual Book', 'Technical Sheet', 'Sertifikasi', 'Company Profile'] @endphp
            @foreach($cats as $i => $cat)
            <button style="padding:10px 22px;font-size:14px;font-weight:500;border-radius:var(--lp-radius-full);border:none;cursor:pointer;transition:all 0.2s;{{ $i === 0 ? 'background:var(--lp-primary);color:white;' : 'background:var(--lp-white);color:var(--lp-gray-600);border:1px solid var(--lp-gray-200);' }}" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='{{ $i === 0 ? 'var(--lp-primary)' : 'var(--lp-white)' }}';this.style.color='{{ $i === 0 ? 'white' : 'var(--lp-gray-600)' }}'">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="lp-card" style="overflow:hidden;">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));">
                @php
                    $files = [
                        ['name' => 'Katalog Produk 2026', 'cat' => 'Katalog Produk', 'size' => '15.2 MB', 'type' => 'PDF', 'desc' => 'Katalog lengkap semua produk mesin industri'],
                        ['name' => 'Brosur Excavator EC480D', 'cat' => 'Brosur', 'size' => '3.8 MB', 'type' => 'PDF', 'desc' => 'Informasi detail Excavator EC480D'],
                        ['name' => 'Manual Book EC480D', 'cat' => 'Manual Book', 'size' => '8.5 MB', 'type' => 'PDF', 'desc' => 'Buku panduan operasi dan perawatan'],
                        ['name' => 'Technical Sheet Bulldozer D6R2', 'cat' => 'Technical Sheet', 'size' => '2.1 MB', 'type' => 'PDF', 'desc' => 'Spesifikasi teknis Bulldozer D6R2'],
                        ['name' => 'Company Profile 2026', 'cat' => 'Company Profile', 'size' => '5.6 MB', 'type' => 'PDF', 'desc' => 'Profil perusahaan dan portofolio'],
                        ['name' => 'Sertifikat ISO 9001', 'cat' => 'Sertifikasi', 'size' => '1.2 MB', 'type' => 'PDF', 'desc' => 'Sertifikat sistem manajemen mutu'],
                        ['name' => 'Katalog Spare Parts', 'cat' => 'Katalog Produk', 'size' => '12.4 MB', 'type' => 'PDF', 'desc' => 'Katalog suku cadang dan aksesoris'],
                        ['name' => 'Brosur Generator C15', 'cat' => 'Brosur', 'size' => '2.7 MB', 'type' => 'PDF', 'desc' => 'Informasi Generator C15 500kVA'],
                        ['name' => 'Technical Sheet CNC VF-2', 'cat' => 'Technical Sheet', 'size' => '1.8 MB', 'type' => 'PDF', 'desc' => 'Spesifikasi teknis CNC Milling VF-2'],
                    ];
                @endphp
                @foreach($files as $file)
                <div style="padding:24px;border-right:1px solid var(--lp-gray-100);border-bottom:1px solid var(--lp-gray-100);transition:all 0.2s;" onmouseover="this.style.boxShadow='var(--lp-shadow-md)'" onmouseout="this.style.boxShadow='none'">
                    <div style="display:flex;align-items:flex-start;gap:16px;">
                        <div style="width:48px;height:48px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-lg);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)'">
                            <i class="fas fa-file-pdf" style="color:var(--lp-primary);font-size:20px;transition:all 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='var(--lp-primary)'"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <h3 style="font-size:15px;font-weight:600;color:var(--lp-gray-800);margin:0 0 2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $file['name'] }}</h3>
                            <p style="font-size:13px;color:var(--lp-gray-500);margin:0;">{{ $file['desc'] }}</p>
                            <div style="display:flex;align-items:center;gap:12px;margin-top:8px;">
                                <span class="lp-badge lp-badge-primary" style="font-size:11px;padding:2px 8px;">{{ $file['type'] }}</span>
                                <span style="font-size:12px;color:var(--lp-gray-400);">{{ $file['size'] }}</span>
                                <span style="font-size:12px;color:var(--lp-gray-400);">{{ $file['cat'] }}</span>
                            </div>
                        </div>
                        <a href="#" style="flex-shrink:0;width:40px;height:40px;background:var(--lp-secondary-lighter);color:var(--lp-secondary);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;transition:all 0.2s;text-decoration:none;" onmouseover="this.style.background='var(--lp-secondary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-secondary-lighter)';this.style.color='var(--lp-secondary)'" title="Download">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <nav style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:40px;">
            <span style="padding:10px 18px;font-size:14px;font-weight:600;background:var(--lp-primary);color:white;border-radius:var(--lp-radius-md);">1</span>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">2</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">3</a>
            <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'"><i class="fas fa-chevron-right"></i></a>
        </nav>
    </div>
</section>
@endsection
