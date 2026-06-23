<footer class="lp-footer">
    <div class="lp-footer-grid">
        <div>
            <div class="lp-footer-brand">
                <div class="lp-logo">
                    <div class="lp-logo-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <div>
                        <div class="lp-logo-text">Perusahaan Mesin</div>
                        <div class="lp-logo-sub">Industrial Machinery Solutions</div>
                    </div>
                </div>
            </div>
            <p class="lp-footer-desc">Distributor resmi dan penyedia solusi mesin industri terpercaya di Indonesia sejak 2010. Melayani ribuan pelanggan di seluruh nusantara.</p>
            <div class="lp-footer-social">
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <div>
            <h3 class="lp-footer-title">Produk</h3>
            <ul class="lp-footer-links">
                <li><a href="{{ route('products.index') }}?category=konstruksi"><i class="fas fa-chevron-right"></i>Mesin Konstruksi</a></li>
                <li><a href="{{ route('products.index') }}?category=pertanian"><i class="fas fa-chevron-right"></i>Mesin Pertanian</a></li>
                <li><a href="{{ route('products.index') }}?category=manufaktur"><i class="fas fa-chevron-right"></i>Mesin Manufaktur</a></li>
                <li><a href="{{ route('products.index') }}?category=energi"><i class="fas fa-chevron-right"></i>Mesin Energi</a></li>
                <li><a href="{{ route('products.index') }}?category=pengolahan"><i class="fas fa-chevron-right"></i>Mesin Pengolahan</a></li>
                <li><a href="{{ route('products.index') }}?category=otomasi"><i class="fas fa-chevron-right"></i>Sistem Otomasi</a></li>
                <li><a href="{{ route('products.index') }}?category=suku-cadang"><i class="fas fa-chevron-right"></i>Suku Cadang & Layanan</a></li>
            </ul>
        </div>

        <div>
            <h3 class="lp-footer-title">Perusahaan</h3>
            <ul class="lp-footer-links">
                <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i>Tentang Kami</a></li>
                <li><a href="{{ route('careers.index') }}"><i class="fas fa-chevron-right"></i>Karir</a></li>
                <li><a href="{{ route('articles.index') }}"><i class="fas fa-chevron-right"></i>Blog & Artikel</a></li>
                <li><a href="{{ route('faq.index') }}"><i class="fas fa-chevron-right"></i>FAQ</a></li>
                <li><a href="{{ route('contact.index') }}"><i class="fas fa-chevron-right"></i>Hubungi Kami</a></li>
                <li><a href="{{ route('downloads.index') }}"><i class="fas fa-chevron-right"></i>Download Center</a></li>
                <li><a href="{{ route('testimonials.index') }}"><i class="fas fa-chevron-right"></i>Testimonial</a></li>
            </ul>
        </div>

        <div>
            <h3 class="lp-footer-title">Kontak</h3>
            <ul class="lp-footer-contact">
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Kantor Pusat</strong>
                        <span>Jl. Industri Raya No. 123, Kelapa Gading, Jakarta Utara 14240</span>
                    </div>
                </li>
                <li>
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Telepon</strong>
                        <a href="tel:+622112345678">(021) 1234-5678</a>
                    </div>
                </li>
                <li>
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <strong>WhatsApp</strong>
                        <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
                    </div>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <div>
                        <strong>Email</strong>
                        <a href="mailto:info@perusahaan.com">info@perusahaan.com</a>
                    </div>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <div>
                        <strong>Jam Kerja</strong>
                        <span>Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 14:00</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="lp-footer-bottom">
        <p class="lp-footer-copyright">&copy; {{ date('Y') }} Perusahaan Mesin Industri. All rights reserved.</p>
        <div class="lp-footer-bottom-links">
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Sitemap</a>
        </div>
    </div>
</footer>
