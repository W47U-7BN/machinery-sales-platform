@extends('layouts.landing')

@section('title', 'Konsultasi Teknis Gratis - Perusahaan Mesin Industri')
@section('meta_description', 'Dapatkan konsultasi teknis gratis dari tim ahli mesin industri kami. Tersedia konsultasi langsung, telepon, atau via WhatsApp.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 100px;position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(231,130,22,0.12) 0%,transparent 60%),radial-gradient(ellipse at 70% 20%,rgba(231,130,22,0.06) 0%,transparent 50%);"></div>
    <div class="lp-container" style="position:relative;z-index:1;">
        @include('partials.breadcrumb', ['items' => [['label' => 'Konsultasi']]])
        <div style="max-width:720px;">
            <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(231,130,22,0.12);border:1px solid rgba(231,130,22,0.2);border-radius:var(--lp-radius-full);padding:6px 16px 6px 6px;margin-bottom:20px;margin-top:16px;">
                <span style="background:var(--lp-secondary);color:white;font-size:11px;font-weight:700;padding:3px 10px;border-radius:var(--lp-radius-full);text-transform:uppercase;letter-spacing:0.5px;">Gratis</span>
                <span style="font-size:13px;color:rgba(255,255,255,0.7);">Tanpa biaya. Tanpa komitmen.</span>
            </div>
            <h1 class="lp-title" style="color:white;font-size:clamp(32px,5vw,52px);line-height:1.15;margin:0 0 16px;">
                Konsultasi Teknis<br>
                <span style="background:linear-gradient(135deg,var(--lp-secondary),var(--lp-secondary-light));-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Bersama Ahli Mesin Industri</span>
            </h1>
            <p style="color:rgba(255,255,255,0.6);font-size:18px;line-height:1.7;max-width:580px;margin:0 0 32px;">
                Tim technical sales kami siap membantu Anda memilih mesin yang tepat, menghitung spesifikasi, dan memberikan rekomendasi terbaik untuk bisnis Anda.
            </p>
            <div style="display:flex;flex-wrap:wrap;gap:12px;">
                <a href="#konsultasi-form" class="lp-btn lp-btn-primary lp-btn-lg">
                    <i class="fas fa-headset"></i>
                    <span>Mulai Konsultasi</span>
                </a>
                <a href="https://wa.me/6281234567890" target="_blank" class="lp-btn" style="background:rgba(255,255,255,0.08);color:white;border:1px solid rgba(255,255,255,0.15);padding:14px 28px;border-radius:var(--lp-radius-lg);font-weight:600;display:inline-flex;align-items:center;gap:8px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.15)'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                    <i class="fab fa-whatsapp"></i>
                    <span>Chat via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:80px 0;">
    <div class="lp-container">
        <div class="lp-text-center" style="margin-bottom:56px;">
            <span class="lp-badge">Proses Konsultasi</span>
            <h2 class="lp-title" style="font-size:clamp(26px,3vw,36px);margin:12px 0 0;">Bagaimana Cara Kerjanya?</h2>
            <p style="color:var(--lp-gray-500);font-size:16px;max-width:520px;margin:12px auto 0;">Tiga langkah mudah untuk mendapatkan solusi mesin industri yang tepat</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;counter-reset:step;">
            @php $steps = [
                ['icon' => 'fa-paper-plane', 'title' => 'Kirim Permintaan', 'desc' => 'Isi form konsultasi dengan detail kebutuhan mesin dan tantangan yang Anda hadapi.'],
                ['icon' => 'fa-search', 'title' => 'Analisis Kebutuhan', 'desc' => 'Tim teknis kami akan menganalisis kebutuhan Anda dan menyiapkan rekomendasi terbaik.'],
                ['icon' => 'fa-check-circle', 'title' => 'Dapatkan Solusi', 'desc' => 'Terima rekomendasi mesin, spesifikasi teknis, dan penawaran harga yang sesuai.'],
            ] @endphp
            @foreach($steps as $i => $step)
            <div style="text-align:center;padding:40px 24px;background:var(--lp-card-bg);border-radius:var(--lp-radius-xl);border:1px solid var(--lp-gray-100);position:relative;">
                <div style="width:56px;height:56px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-lg);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:22px;color:var(--lp-primary);">
                    <i class="fas {{ $step['icon'] }}"></i>
                </div>
                <div style="position:absolute;top:16px;right:20px;font-size:32px;font-weight:800;color:var(--lp-gray-100);counter-increment:step;">0{{ $i + 1 }}</div>
                <h3 style="font-size:17px;font-weight:700;color:var(--lp-gray-800);margin:0 0 8px;">{{ $step['title'] }}</h3>
                <p style="font-size:14px;color:var(--lp-gray-500);margin:0;line-height:1.6;">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="konsultasi-form" class="lp-section lp-fade-in" style="padding:80px 0;background:var(--lp-gray-50);">
    <div class="lp-container">
        <div style="display:grid;grid-template-columns:1.2fr 1fr;gap:48px;align-items:start;">
            <div>
                <span class="lp-badge">Mulai Konsultasi</span>
                <h2 class="lp-title" style="font-size:clamp(24px,2.5vw,32px);margin:12px 0 16px;">Isi Form Konsultasi Teknis</h2>
                <p style="color:var(--lp-gray-500);font-size:15px;margin:0 0 32px;line-height:1.7;">Tim kami akan menghubungi Anda dalam 1x24 jam untuk mendiskusikan kebutuhan mesin industri Anda.</p>
                <form action="{{ route('contact.store') }}" method="POST" style="display:flex;flex-direction:column;gap:16px;">
                    @csrf
                    <input type="hidden" name="subject" value="Konsultasi Produk">
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
                            <label class="lp-form-label">Perusahaan</label>
                            <input type="text" name="company" class="lp-input" placeholder="Nama Perusahaan">
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Industri *</label>
                            <select name="industry" class="lp-input" required>
                                <option value="">Pilih Industri</option>
                                <option>Konstruksi</option>
                                <option>Pertambangan</option>
                                <option>Agrikultur</option>
                                <option>Manufaktur</option>
                                <option>Logistik</option>
                                <option>Food & Beverage</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="lp-form-group" style="margin-bottom:0;">
                            <label class="lp-form-label">Jenis Mesin</label>
                            <select name="machine_type" class="lp-input">
                                <option value="">Pilih Jenis (Opsional)</option>
                                <option>Mesin Konstruksi</option>
                                <option>Alat Berat</option>
                                <option>Mesin Produksi</option>
                                <option>Mesin Packaging</option>
                                <option>Mesin Pertanian</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Deskripsi Kebutuhan *</label>
                        <textarea name="message" rows="5" class="lp-input" placeholder="Jelaskan kebutuhan mesin, kapasitas yang dibutuhkan, tantangan yang dihadapi..." required></textarea>
                    </div>
                    <div class="lp-form-group">
                        <label class="lp-form-label">Waktu Kontak yang Diinginkan</label>
                        <select name="contact_time" class="lp-input">
                            <option value="">Kapan saja</option>
                            <option>Pagi (08:00 - 11:00)</option>
                            <option>Siang (11:00 - 14:00)</option>
                            <option>Sore (14:00 - 17:00)</option>
                        </select>
                    </div>
                    <button type="submit" class="lp-btn lp-btn-primary lp-btn-lg" style="align-self:flex-start;">
                        <i class="fas fa-headset"></i>
                        <span>Kirim Permintaan Konsultasi</span>
                    </button>
                </form>
            </div>
            <div style="display:flex;flex-direction:column;gap:24px;">
                <div class="lp-feature-card" style="padding:28px;">
                    <h3 style="font-size:17px;font-weight:700;color:var(--lp-primary);margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-check-circle" style="color:var(--lp-secondary);"></i>
                        <span>Mengapa Konsultasi dengan Kami?</span>
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:16px;">
                        @php $benefits = [
                            ['icon' => 'fa-user-tie', 'title' => 'Tim Ahli Bersertifikasi', 'desc' => 'Didukung teknisi dan insinyur berpengalaman di bidang mesin industri.'],
                            ['icon' => 'fa-chart-line', 'title' => 'Analisis Kebutuhan Gratis', 'desc' => 'Kami akan menganalisis kebutuhan bisnis Anda tanpa biaya.'],
                            ['icon' => 'fa-rocket', 'title' => 'Respon Cepat', 'desc' => 'Tim kami akan merespon permintaan Anda dalam 1x24 jam.'],
                            ['icon' => 'fa-cogs', 'title' => 'Solusi Tepat Sasaran', 'desc' => 'Rekomendasi mesin yang sesuai dengan kebutuhan spesifik bisnis Anda.'],
                        ] @endphp
                        @foreach($benefits as $b)
                        <div style="display:flex;gap:14px;">
                            <div style="width:44px;height:44px;min-width:44px;background:var(--lp-primary-lighter);border-radius:var(--lp-radius-md);display:flex;align-items:center;justify-content:center;color:var(--lp-primary);font-size:18px;">
                                <i class="fas {{ $b['icon'] }}"></i>
                            </div>
                            <div>
                                <p style="font-weight:600;color:var(--lp-gray-800);font-size:14px;margin:0 0 4px;">{{ $b['title'] }}</p>
                                <p style="font-size:13px;color:var(--lp-gray-500);margin:0;">{{ $b['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div style="background:linear-gradient(135deg,var(--lp-primary),#1a3a5c);border-radius:var(--lp-radius-xl);padding:28px;color:white;">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
                        <i class="fas fa-phone-volume" style="font-size:28px;color:var(--lp-secondary-light);"></i>
                        <h3 style="font-size:18px;font-weight:700;margin:0;">Butuh Bantuan Langsung?</h3>
                    </div>
                    <p style="font-size:14px;color:rgba(255,255,255,0.7);margin:0 0 16px;">Hubungi tim technical sales kami sekarang</p>
                    <a href="tel:+622112345678" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px 24px;background:rgba(255,255,255,0.15);color:white;font-weight:600;border:1px solid rgba(255,255,255,0.2);border-radius:var(--lp-radius-lg);font-size:15px;text-decoration:none;transition:all 0.2s;margin-bottom:10px;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <i class="fas fa-phone"></i>
                        <span>(021) 1234-5678</span>
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px 24px;background:#25d366;color:white;font-weight:600;border:none;border-radius:var(--lp-radius-lg);font-size:15px;text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='#1da851'" onmouseout="this.style.background='#25d366'">
                        <i class="fab fa-whatsapp"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:80px 0;">
    <div class="lp-container">
        <div class="lp-text-center" style="margin-bottom:48px;">
            <span class="lp-badge">Testimonial</span>
            <h2 class="lp-title" style="font-size:clamp(24px,2.5vw,32px);margin:12px 0 0;">Apa Kata Klien Kami</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
            @php $testimonials = [
                ['text' => 'Tim konsultasi sangat membantu dalam memilih mesin yang tepat untuk pabrik kami. Analisis kebutuhannya sangat detail dan profesional.', 'name' => 'Budi Santoso', 'title' => 'PT Maju Jaya Konstruksi'],
                ['text' => 'Proses konsultasi gratisnya sangat informatif. Saya mendapat rekomendasi mesin yang sesuai budget dan kebutuhan produksi.', 'name' => 'Rina Wijaya', 'title' => 'CV Karya Mandiri'],
                ['text' => 'Teknisinya datang langsung ke lokasi untuk survey. Sangat puas dengan pelayanan dan keahlian tim technical sales.', 'name' => 'Andi Pratama', 'title' => 'PT Bumi Indah Perkasa'],
            ] @endphp
            @foreach($testimonials as $t)
            <div class="lp-feature-card" style="padding:28px;display:flex;flex-direction:column;">
                <div style="color:var(--lp-secondary);margin-bottom:16px;font-size:14px;letter-spacing:2px;">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p style="font-size:14px;color:var(--lp-gray-600);line-height:1.7;margin:0 0 20px;font-style:italic;">"{{ $t['text'] }}"</p>
                <div style="margin-top:auto;display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;border-radius:50%;background:var(--lp-primary-lighter);display:flex;align-items:center;justify-content:center;color:var(--lp-primary);font-weight:700;font-size:14px;">{{ substr($t['name'], 0, 1) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:14px;color:var(--lp-gray-800);margin:0;">{{ $t['name'] }}</p>
                        <p style="font-size:12px;color:var(--lp-gray-500);margin:0;">{{ $t['title'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="lp-section lp-fade-in" style="padding:80px 0;background:var(--lp-gray-50);">
    <div class="lp-container">
        <div class="lp-text-center" style="margin-bottom:40px;">
            <h2 class="lp-title" style="font-size:clamp(22px,2.5vw,30px);margin:0;">Pertanyaan Umum Seputar Konsultasi</h2>
        </div>
        <div style="max-width:720px;margin:0 auto;display:flex;flex-direction:column;gap:12px;">
            @php $faqs = [
                ['q' => 'Apakah konsultasi benar-benar gratis?', 'a' => 'Ya, konsultasi teknis awal sepenuhnya gratis tanpa biaya dan tanpa komitmen.'],
                ['q' => 'Berapa lama proses konsultasi?', 'a' => 'Tim kami akan merespon dalam 1x24 jam. Proses konsultasi hingga rekomendasi biasanya memakan waktu 2-3 hari kerja.'],
                ['q' => 'Apa yang perlu saya siapkan?', 'a' => 'Cukup sampaikan kebutuhan mesin, kapasitas yang diinginkan, dan tantangan yang dihadapi. Tim kami akan membantu sisanya.'],
                ['q' => 'Apakah tim survey bisa datang ke lokasi?', 'a' => 'Ya, untuk proyek tertentu kami menyediakan jasa survey lapangan untuk analisis yang lebih akurat.'],
            ] @endphp
            @foreach($faqs as $f)
            <details style="background:var(--lp-card-bg);border:1px solid var(--lp-gray-100);border-radius:var(--lp-radius-lg);padding:0;overflow:hidden;">
                <summary style="padding:18px 20px;font-weight:600;font-size:15px;color:var(--lp-gray-800);cursor:pointer;display:flex;align-items:center;justify-content:space-between;list-style:none;">
                    <span>{{ $f['q'] }}</span>
                    <i class="fas fa-chevron-down" style="color:var(--lp-gray-400);font-size:12px;transition:transform 0.2s;"></i>
                </summary>
                <div style="padding:0 20px 18px;font-size:14px;color:var(--lp-gray-500);line-height:1.7;">
                    {{ $f['a'] }}
                </div>
            </details>
            @endforeach
        </div>
        <div class="lp-text-center" style="margin-top:40px;">
            <p style="font-size:15px;color:var(--lp-gray-600);">Masih punya pertanyaan? <a href="{{ route('contact.index') }}" style="color:var(--lp-primary);font-weight:600;text-decoration:none;">Hubungi kami</a></p>
        </div>
    </div>
</section>
@endsection
