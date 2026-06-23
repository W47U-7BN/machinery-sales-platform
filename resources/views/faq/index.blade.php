@extends('layouts.landing')

@section('title', 'FAQ - Pertanyaan yang Sering Diajukan')
@section('meta_description', 'Temukan jawaban untuk pertanyaan umum tentang produk, layanan, pengiriman, garansi, dan lainnya.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'FAQ']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">FAQ</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Pertanyaan yang sering diajukan tentang produk dan layanan kami</p>
    </div>
</section>

<section class="lp-section lp-gray-section">
    <div class="lp-container" style="max-width:800px;">
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:8px;margin-bottom:40px;">
            @php $cats = ['Semua', 'Produk', 'Pemesanan', 'Pengiriman', 'Pembayaran', 'Garansi', 'Layanan'] @endphp
            @foreach($cats as $i => $cat)
            <button style="padding:10px 22px;font-size:14px;font-weight:500;border-radius:var(--lp-radius-full);border:none;cursor:pointer;transition:all 0.2s;{{ $i === 0 ? 'background:var(--lp-primary);color:white;' : 'background:var(--lp-white);color:var(--lp-gray-600);border:1px solid var(--lp-gray-200);' }}" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='{{ $i === 0 ? 'var(--lp-primary)' : 'var(--lp-white)' }}';this.style.color='{{ $i === 0 ? 'white' : 'var(--lp-gray-600)' }}'">{{ $cat }}</button>
            @endforeach
        </div>

        <div style="display:flex;flex-direction:column;gap:8px;" x-data="{ open: null }">
            @php
                $faqs = [
                    ['q' => 'Bagaimana cara memesan produk?', 'a' => 'Anda dapat memesan produk melalui website, WhatsApp, telepon, atau datang langsung ke kantor kami. Tim sales kami akan membantu Anda dari awal hingga akhir.'],
                    ['q' => 'Berapa lama waktu pengiriman?', 'a' => 'Waktu pengiriman tergantung lokasi dan jenis produk. Untuk pulau Jawa: 3-7 hari kerja. Luar Jawa: 7-14 hari kerja. Untuk alat berat besar: 14-21 hari kerja.'],
                    ['q' => 'Apa saja metode pembayaran yang tersedia?', 'a' => 'Kami menerima transfer bank (BCA, Mandiri, BNI, BRI), kartu kredit, dan pembayaran melalui perusahaan pembiayaan untuk pembelian alat berat.'],
                    ['q' => 'Apakah produk yang dijual original dan bergaransi?', 'a' => 'Semua produk yang kami jual adalah produk original dengan garansi resmi dari pabrikan. Garansi bervariasi dari 1-5 tahun tergantung jenis produk.'],
                    ['q' => 'Bagaimana jika produk rusak saat pengiriman?', 'a' => 'Kami menanggung penuh kerusakan saat pengiriman. Segera laporkan ke tim kami untuk proses klaim dan penggantian barang.'],
                    ['q' => 'Apakah tersedia layanan instalasi?', 'a' => 'Ya, kami menyediakan layanan instalasi dan commissioning oleh teknisi kami untuk produk-produk tertentu. Biaya instalasi akan diinformasikan saat konsultasi.'],
                    ['q' => 'Bagaimana cara klaim garansi?', 'a' => 'Hubungi tim layanan kami melalui WhatsApp atau telepon. Siapkan nomor seri produk dan bukti pembelian. Kami akan memproses klaim garansi Anda.'],
                    ['q' => 'Apakah ada minimal pembelian?', 'a' => 'Tidak ada minimal pembelian untuk produk-produk tertentu. Untuk alat berat dan mesin besar, biasanya dilayani per unit.'],
                    ['q' => 'Apakah bisa kunjungan ke lapangan?', 'a' => 'Ya, tim sales dan teknis kami siap melakukan kunjungan ke lokasi proyek Anda untuk konsultasi dan survey kebutuhan.'],
                    ['q' => 'Bagaimana cara menjadi distributor?', 'a' => 'Hubungi team partnership kami melalui email partnership@perusahaan.com atau melalui formulir kontak dengan subjek Kerjasama / Distributor.'],
                ];
            @endphp
            @foreach($faqs as $i => $faq)
            <div class="lp-card" style="overflow:visible;" x-data="{ open: false }">
                <button @click="open = !open" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:20px 24px;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit;">
                    <span style="font-size:15px;font-weight:600;color:var(--lp-gray-800);padding-right:16px;">{{ $faq['q'] }}</span>
                    <i class="fas fa-chevron-down" style="color:var(--lp-gray-400);flex-shrink:0;transition:transform 0.3s;" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse>
                    <div style="padding:0 24px 20px;font-size:15px;color:var(--lp-gray-600);line-height:1.7;">{{ $faq['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:48px;padding:40px;background:var(--lp-primary);border-radius:var(--lp-radius-xl);">
            <h3 style="font-size:20px;font-weight:700;color:white;margin:0 0 8px;">Tidak menemukan jawaban?</h3>
            <p style="color:rgba(255,255,255,0.7);margin:0 0 20px;">Tim kami siap membantu Anda</p>
            <a href="{{ route('contact.index') }}" class="lp-btn lp-btn-primary lp-btn-lg">
                <i class="fas fa-headset"></i>
                <span>Hubungi Kami</span>
            </a>
        </div>
    </div>
</section>
@endsection
