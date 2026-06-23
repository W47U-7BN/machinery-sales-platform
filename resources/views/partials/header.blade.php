<header class="lp-header" id="lp-header">
    <div class="lp-header-inner">
        <a href="{{ route('home') }}" class="lp-logo group">
            <div class="lp-logo-icon">
                <i class="fas fa-industry"></i>
            </div>
            <div>
                <div class="lp-logo-text group-hover:opacity-80 transition-opacity">Perusahaan Mesin</div>
                <div class="lp-logo-sub">Industrial Machinery Solutions</div>
            </div>
        </a>

        <nav class="lp-nav" role="navigation">
            <a href="{{ route('home') }}" class="lp-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('products.index') }}" class="lp-nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">Produk</a>
            <a href="{{ route('articles.index') }}" class="lp-nav-link {{ request()->routeIs('articles*') ? 'active' : '' }}">Artikel</a>
            <a href="{{ route('about') }}" class="lp-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
            <a href="{{ route('contact.index') }}" class="lp-nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">Kontak</a>
        </nav>

        <div class="lp-nav-cta">
            <a href="{{ route('konsultasi') }}" class="lp-btn lp-btn-ghost lp-btn-sm hidden sm:inline-flex">
                <i class="fas fa-headset"></i>
                <span>Konsultasi</span>
            </a>
            <a href="{{ route('penawaran') }}" class="lp-btn lp-btn-primary lp-btn-sm hidden sm:inline-flex">
                <i class="fas fa-file-invoice"></i>
                <span>Minta Penawaran</span>
            </a>
            <button id="hamburger-btn" class="lp-hamburger" aria-label="Toggle menu" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lp-mobile-menu">
        <a href="{{ route('home') }}" class="lp-mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
        <a href="{{ route('products.index') }}" class="lp-mobile-nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">Produk</a>
        <a href="{{ route('articles.index') }}" class="lp-mobile-nav-link {{ request()->routeIs('articles*') ? 'active' : '' }}">Artikel</a>
        <a href="{{ route('about') }}" class="lp-mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
        <a href="{{ route('contact.index') }}" class="lp-mobile-nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">Kontak</a>
        <div class="lp-mobile-cta">
            <a href="{{ route('konsultasi') }}" class="lp-btn lp-btn-dark lp-btn-block">
                <i class="fas fa-headset"></i>
                <span>Konsultasi Gratis</span>
            </a>
            <a href="{{ route('penawaran') }}" class="lp-btn lp-btn-primary lp-btn-block">
                <i class="fas fa-file-invoice"></i>
                <span>Minta Penawaran</span>
            </a>
            <button onclick="window.toggleTheme()" class="lp-btn lp-btn-outline lp-btn-block" style="border-color:var(--lp-gray-200);color:var(--lp-gray-700);">
                <i class="fas fa-moon"></i>
                <span>Ganti Tema</span>
            </button>
        </div>
    </div>
</header>
