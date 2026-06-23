@extends('layouts.landing')

@section('title', 'Minta Penawaran Harga - Perusahaan Mesin Industri')
@section('meta_description', 'Ajukan permintaan penawaran harga mesin industri. Dapatkan harga kompetitif, diskon volume, dan layanan purna jual terbaik.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 100px;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 70% 30%,rgba(231,130,22,0.15) 0%,transparent 60%),radial-gradient(ellipse at 20% 80%,rgba(231,130,22,0.05) 0%,transparent 50%);"></div>
    <div class="lp-container" style="position:relative;z-index:1;">
        @include('partials.breadcrumb', ['items' => [['label' => 'Penawaran']]])
        <div style="max-width:720px;">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(231,130,22,0.12);border:1px solid rgba(231,130,22,0.2);border-radius:var(--lp-radius-full);padding:6px 16px 6px 6px;margin-bottom:20px;margin-top:16px;">
                <span style="background:var(--lp-secondary);color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:var(--lp-radius-full);text-transform:uppercase;letter-spacing:0.5px;">Harga Kompetitif</span>
                <span style="font-size:13px;color:rgba(255,255,255,0.7);">Diskon volume & gratis ongkir*</span>
            </div>
            <h1 class="lp-title" style="color:white;font-size:clamp(32px,5vw,52px);line-height:1.15;margin:0 0 16px;">
                Minta Penawaran Harga<br>
                <span style="background:linear-gradient(135deg,var(--lp-secondary),var(--lp-secondary-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Mesin Industri Terbaik</span>
            </h1>
            <p style="color:rgba(255,255,255,0.6);font-size:18px;line-height:1.7;max-width:580px;margin:0 0 32px;">
                Dapatkan penawaran harga terbaik untuk kebutuhan mesin industri Anda. Kami menyediakan produk berkualitas dengan dukungan purna jual lengkap.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;">
                <a href="#penawaran-form" class="lp-btn lp-btn-primary lp-btn-lg">
                    <i class="fas fa-file-invoice"></i>
                    <span>Ajukan Penawaran</span>
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="lp-btn" style="background:rgba(255,255,255,0.08);color:white;border:1px solid rgba(255,255,255,0.15);padding:14px 28px;border-radius:var(--lp-radius-lg);font-weight:600;display:inline-flex;align-items:center;gap:8px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                    <i class="fab fa-whatsapp"></i>
                    <span>Tanya via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:60px 0;background:var(--lp-gray-50);">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;">
            @php $stats = [
                ['value' => '500+', 'label' => 'Proyek Selesai'],
                ['value' => '200+', 'label' => 'Klien Korporasi'],
                ['value' => '15+', 'label' => 'Tahun Pengalaman'],
                ['value' => '98%', 'label' => 'Kepuasan Klien'],
            ] @endphp
            @foreach($stats as $s)
            <div style="text-align:center;padding:24px;background:var(--lp-card-bg);border-radius:var(--lp-radius-lg);border:1px solid var(--lp-gray-100);">
                <p style="font-size:clamp(28px,3vw,38px);font-weight:800;color:var(--lp-primary);margin:0;line-height:1;">{{ $s['value'] }}</p>
                <p style="font-size:13px;color:var(--lp-gray-500);margin:8px 0 0;">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="penawaran-form" class="lp-section lp-fade-in" style="padding:80px 0;">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:1.2fr 1fr;gap:48px;align-items:start;">
            <div>
                <span class="lp-badge">Ajukan Penawaran</span>
                <h2 class="lp-title" style="font-size:clamp(24px,2.5vw,32px);margin:12px 0 16px;">Form Permintaan Penawaran</h2>
                <p style="color:var(--lp-gray-500);font-size:15px;margin:0 0 32px;line-height:1.7;">Isi detail kebutuhan Anda dan tim kami akan mengirimkan penawaran harga terbaik dalam 1x24 jam.</p>
                <form action="{{ route('contact.store') }}" method="POST" style="display:flex;flex-direction:column;gap:16px;">
                    @csrf
                    <input type="hidden" name="subject" value="Permintaan Penawaran">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Nama Lengkap *</label>
                            <input type="text" name="name" class="lp-input" placeholder="Nama Anda" required>
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Email *</label>
                            <input type="email" name="email" class="lp-input" placeholder="email@anda.com" required>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Telepon *</label>
                            <input type="tel" name="phone" class="lp-input" placeholder="08xx-xxxx-xxxx" required>
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Perusahaan *</label>
                            <input type="text" name="company" class="lp-input" placeholder="Nama Perusahaan" required>
                        </div>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Produk yang Dibutuhkan *</label>
                        <select name="product" class="lp-input" required>
                            <option value="">Pilih Produk</option>
                            <option>Excavator EC480D</option>
                            <option>Wheel Loader L120F</option>
                            <option>Bulldozer D375A</option>
                            <option>Motor Grader GD675</option>
                            <option>Compactor CS76</option>
                            <option>Asphalt Paver AP555</option>
                            <option>Crane RT100</option>
                            <option>Forklift FD50</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Jumlah *</label>
                            <input type="number" name="quantity" class="lp-input" placeholder="1" min="1" required>
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Budget Perkiraan</label>
                            <select name="budget" class="lp-input">
                                <option value="">Pilih Range (Opsional)</option>
                                <option>&lt; Rp 100 Juta</option>
                                <option>Rp 100 - 500 Juta</option>
                                <option>Rp 500 Juta - 1 Miliar</option>
                                <option>&gt; Rp 1 Miliar</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Lokasi Pengiriman *</label>
                            <input type="text" name="delivery_location" class="lp-input" placeholder="Kota / Provinsi" required>
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Target Pengiriman</label>
                            <input type="text" name="delivery_target" class="lp-input" placeholder="Contoh: 2 minggu lagi">
                        </div>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Spesifikasi Tambahan</label>
                        <textarea name="message" rows="4" class="lp-input" placeholder="Sebutkan spesifikasi khusus, aksesoris, atau kebutuhan tambahan lainnya..."></textarea>
                    </div>
                    <button type="submit" class="lp-btn lp-btn-primary lp-btn-lg" style="align-self:flex-start;">
                        <i class="fas fa-file-invoice"></i>
                        <span>Kirim Permintaan Penawaran</span>
                    </button>
                </form>
            </div>
            <div style="display:flex;flex-direction:column;gap:24px;">
                <div class="lp-feature-card" style="padding:28px;">
                    <h3 style="font-size:17px;font-weight:700;color:var(--lp-primary);margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-gem" style="color:var(--lp-secondary);"></i>
                        <span>Mengapa Memilih Kami?</span>
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        @php $benefits = [
                            ['icon' => 'fa-tag', 'title' => 'Harga Kompetitif', 'desc' => 'Harga terbaik dengan garansi resmi dan dukungan purna jual.'],
                            ['icon' => 'fa-boxes', 'title' => 'Diskon Volume', 'desc' => 'Dapatkan diskon khusus untuk pembelian dalam jumlah besar.'],
                            ['icon' => 'fa-truck', 'title' => 'Gratis Ongkir*', 'desc' => 'Pengiriman gratis untuk area Jawa dan pesanan tertentu.'],
                            ['icon' => 'fa-tools', 'title' => 'Garansi & Service', 'desc' => 'Garansi mesin hingga 2 tahun dan jaringan service nasional.'],
                            ['icon' => 'fa-handshake', 'title' => 'Pembayaran Fleksibel', 'desc' => 'Tersedia opsi kredit, cicilan, dan leasing untuk korporasi.'],
                        ] @endphp
                        @foreach($benefits as $b)
                        <div style="display:flex;gap:14px;">
                            <div style="width:44px;height:44px;min-width:44px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;color:var(--lp-primary);font-size:18px;">
                                <i class="fas {{ $b['icon'] }}"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 3px;">{{ $b['title'] }}</p>
                                <p style="font-size:13px;color:var(--lp-gray-500);margin:0;">{{ $b['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="background:linear-gradient(135deg,var(--lp-primary),#1a3a5c);border-radius:var(--lp-radius-xl);padding:28px;color:white;">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                        <i class="fas fa-credit-card" style="font-size:28px;color:var(--lp-secondary-light);"></i>
                        <h3 style="font-size:18px;font-weight:700;margin:0;">Metode Pembayaran</h3>
                    </div>
                    <p style="font-size:14px;color:rgba(255,255,255,0.7);margin:0 0 16px;">Kami menerima berbagai metode pembayaran untuk kemudahan transaksi Anda</p>
                    <div style="display:flex;flex-wrap:wrap;gap:10px;">
                        <span style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:var(--lp-radius-md);padding:8px 14px;font-size:13px;display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-building-columns"></i> Transfer Bank
                        </span>
                        <span style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:var(--lp-radius-md);padding:8px 14px;font-size:13px;display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-credit-card"></i> Kartu Kredit
                        </span>
                        <span style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:var(--lp-radius-md);padding:8px 14px;font-size:13px;display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-hand-holding-dollar"></i> Kredit / Leasing
                        </span>
                    </div>
                </div>
                <div style="background:var(--lp-card-bg);border:1px solid var(--lp-gray-100);border-radius:var(--lp-radius-xl);padding:28px;">
                    <h3 style="font-size:17px;font-weight:700;color:var(--lp-gray-800);margin:0 0 16px;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-file-pdf" style="color:var(--lp-secondary);"></i>
                        <span>Prosedur Penawaran</span>
                    </h3>
                    <ol style="margin:0;padding-left:20px;display:flex;flex-direction:column;gap:10px;">
                        <li style="font-size:14px;color:var(--lp-gray-600);">Submit form permintaan penawaran</li>
                        <li style="font-size:14px;color:var(--lp-gray-600);">Tim kami menghubungi dalam 1x24 jam untuk konfirmasi</li>
                        <li style="font-size:14px;color:var(--lp-gray-600);">Dapatkan dokumen penawaran resmi (PDF)</li>
                        <li style="font-size:14px;color:var(--lp-gray-600);">Negosiasi dan kesepakatan harga</li>
                        <li style="font-size:14px;color:var(--lp-gray-600);">Proses pemesanan dan pengiriman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:60px 0;background:var(--lp-gray-50);overflow:hidden;">
    <div class="lp-container">
        <div class="lp-text-center" style="margin-bottom:40px;">
            <span class="lp-badge">Klien Kami</span>
            <h2 class="lp-title" style="font-size:clamp(22px,2.5vw,30px);margin:12px 0 0;">Dipercaya oleh Perusahaan Terkemuka</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:24px;align-items:center;">
            @php $logos = ['PT Wijaya Karya', 'PP Persero', 'PT Adhi Karya', 'PT Hutama Karya', 'PT Pembangunan Perumahan', 'PT Waskita Karya'] @endphp
            @foreach($logos as $logo)
            <div style="text-align:center;padding:20px 12px;background:var(--lp-card-bg);border-radius:var(--lp-radius-lg);border:1px solid var(--lp-gray-100);">
                <div style="width:48px;height:48px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;">
                    <i class="fas fa-industry" style="color:var(--lp-primary);font-size:20px;"></i>
                </div>
                <p style="font-size:11px;font-weight:600;color:var(--lp-gray-600);margin:0;line-height:1.3;">{{ $logo }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:80px 0;">
    <div class="lp-container">
        <div class="lp-text-center" style="margin-bottom:40px;">
            <h2 class="lp-title" style="font-size:clamp(22px,2.5vw,30px);margin:0;">Syarat & Ketentuan Penawaran</h2>
        </div>
        <div style="max-width:720px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            @php $terms = [
                'Penawaran berlaku selama 14 hari sejak diterbitkan.',
                'Harga belum termasuk PPN 11% kecuali disebutkan lain.',
                'Diskon volume berlaku untuk pembelian minimal 3 unit.',
                'Gratis ongkir untuk area Jawa dengan minimal pembelian.',
                'Garansi mesin sesuai ketentuan pabrikan masing-masing produk.',
                'Pembayaran dapat dilakukan via transfer, kartu kredit, atau leasing.',
            ] @endphp
            @foreach($terms as $term)
            <div style="display:flex;gap:10px;align-items:flex-start;padding:12px 16px;background:var(--lp-card-bg);border:1px solid var(--lp-gray-100);border-radius:var(--lp-radius-md);">
                <i class="fas fa-check-circle" style="color:var(--lp-secondary);font-size:14px;margin-top:2px;"></i>
                <span style="font-size:13px;color:var(--lp-gray-600);">{{ $term }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
