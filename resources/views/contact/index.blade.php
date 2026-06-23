@extends('layouts.landing')

@section('title', 'Hubungi Kami - Perusahaan Mesin Industri')
@section('meta_description', 'Hubungi tim sales kami untuk konsultasi, penawaran, dan informasi produk. Tersedia layanan telepon, WhatsApp, email, dan kantor cabang.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Kontak']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Hubungi Kami</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Kami siap membantu Anda. Hubungi tim sales profesional kami untuk konsultasi gratis.</p>
    </div>
</section>

<section class="lp-section lp-fade-in">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:48px;">
            <div>
                <h2 class="lp-title" style="font-size:24px;margin-bottom:24px;">Kirim Pesan</h2>
                <form>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Nama Lengkap *</label>
                            <input type="text" class="lp-input" placeholder="Nama Anda">
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Email *</label>
                            <input type="email" class="lp-input" placeholder="email@anda.com">
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Telepon *</label>
                            <input type="tel" class="lp-input" placeholder="08xx-xxxx-xxxx">
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Perusahaan</label>
                            <input type="text" class="lp-input" placeholder="Nama Perusahaan">
                        </div>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Subjek *</label>
                        <select class="lp-input">
                            <option>Pilih Subjek</option>
                            <option>Permintaan Penawaran</option>
                            <option>Konsultasi Produk</option>
                            <option>Dukungan Teknis</option>
                            <option>Kerjasama / Distributor</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Pesan *</label>
                        <textarea rows="5" class="lp-input" placeholder="Tulis pesan Anda..."></textarea>
                    </div>
                    <button type="submit" class="lp-btn lp-btn-dark lp-btn-lg">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Pesan</span>
                    </button>
                </form>
            </div>

            <div style="display:flex;flex-direction:column;gap:24px;">
                <div class="lp-feature-card" style="padding:28px;">
                    <h3 style="font-size:17px;font-weight:700;color:var(--lp-primary);margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-address-card" style="color:var(--lp-secondary);"></i>
                        <span>Informasi Kontak</span>
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:16px;">
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:40px;height:40px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-map-marker-alt" style="color:var(--lp-primary);"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 2px;">Kantor Pusat</p>
                                <p style="font-size:14px;color:var(--lp-gray-500);margin:0;">Jl. Industri Raya No. 123<br>Kelapa Gading, Jakarta Utara 14240</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:40px;height:40px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fas fa-phone" style="color:var(--lp-primary);"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 2px;">Telepon</p>
                                <a href="tel:+622112345678" style="font-size:14px;color:var(--lp-gray-500);text-decoration:none;">(021) 1234-5678</a>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:40px;height:40px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fab fa-whatsapp" style="color:var(--lp-primary);"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 2px;">WhatsApp</p>
                                <a href="https://wa.me/6281234567890" style="font-size:14px;color:var(--lp-gray-500);text-decoration:none;" target="_blank">+62 812-3456-7890</a>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:40px;height:40px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="far fa-envelope" style="color:var(--lp-primary);"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 2px;">Email</p>
                                <a href="mailto:info@perusahaan.com" style="font-size:14px;color:var(--lp-gray-500);text-decoration:none;">info@perusahaan.com</a>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:12px;">
                            <div style="width:40px;height:40px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="far fa-clock" style="color:var(--lp-primary);"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 2px;">Jam Kerja</p>
                                <p style="font-size:14px;color:var(--lp-gray-500);margin:0;">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 14:00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background:var(--lp-primary);border-radius:var(--lp-radius-xl);padding:28px;color:white;">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                        <i class="fas fa-headset" style="font-size:28px;color:var(--lp-secondary-light);"></i>
                        <h3 style="font-size:18px;font-weight:700;margin:0;">Butuh Bantuan Cepat?</h3>
                    </div>
                    <p style="font-size:14px;color:rgba(255,255,255,0.7);margin:0 0 16px;">Tim sales kami siap melayani Anda via WhatsApp</p>
                    <a href="https://wa.me/6281234567890" target="_blank" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px 24px;background:#25d366;color:white;font-weight:600;border:none;border-radius:var(--lp-radius-lg);font-size:15px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='#1da851'" onmouseout="this.style.background='#25d366'">
                        <i class="fab fa-whatsapp"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="height:400px;background:var(--lp-gray-100);position:relative;">
    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:var(--lp-gray-400);">
        <div class="lp-text-center">
            <i class="fas fa-map-marked-alt" style="font-size:40px;margin-bottom:12px;display:block;"></i>
            <p style="font-size:16px;font-weight:500;">Google Maps akan ditampilkan di sini</p>
            <p style="font-size:14px;color:var(--lp-gray-400);">Jl. Industri Raya No. 123, Kelapa Gading, Jakarta Utara</p>
        </div>
    </div>
</section>
@endsection
