<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Vendor {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saas-loading.css') }}">
    <style>
        .portal-sidebar { background: linear-gradient(180deg, #1e1b4b 0%, #312e81 100%); }
        .portal-sidebar .nav-link.active { background: rgba(99,102,241,0.15); color: #a5b4fc; }
    </style>
    @stack('styles')
</head>
<body>
    <div id="saas-preloader">
        <div class="saas-preloader-logo">
            <div class="logo-ring"></div>
            <div class="logo-icon">V</div>
        </div>
        <div class="saas-preloader-bars">
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
        </div>
        <div class="saas-preloader-text">Loading vendor portal...</div>
        <div class="saas-preloader-progress"><div class="progress-fill"></div></div>
    </div>

    <div class="saas-toast-container"></div>

    <div id="saas-wrapper">
        <div class="saas-sidebar-overlay" data-sidebar-overlay></div>

        <aside class="saas-sidebar portal-sidebar" id="saas-sidebar">
            <a href="{{ route('vendor.dashboard') }}" class="saas-sidebar-brand">
                <div class="brand-logo">V</div>
                <div class="brand-text">
                    <span class="brand-name">Vendor Portal</span>
                    <span class="brand-sub">{{ config('app.name') }}</span>
                </div>
            </a>
            <nav class="saas-sidebar-menu">
                <div class="menu-label">Menu</div>
                <div class="nav-item">
                    <a href="{{ route('vendor.dashboard') }}" class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill nav-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('vendor.products.index') }}" class="nav-link {{ request()->routeIs('vendor.products.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam nav-icon"></i><span class="nav-text">Produk</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('vendor.purchase-orders.index') }}" class="nav-link {{ request()->routeIs('vendor.purchase-orders.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text nav-icon"></i><span class="nav-text">Purchase Orders</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('vendor.payments.index') }}" class="nav-link {{ request()->routeIs('vendor.payments.*') ? 'active' : '' }}">
                        <i class="bi bi-credit-card nav-icon"></i><span class="nav-text">Pembayaran</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('vendor.documents.index') }}" class="nav-link {{ request()->routeIs('vendor.documents.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark nav-icon"></i><span class="nav-text">Dokumen</span>
                    </a>
                </div>
            </nav>
            <div class="saas-sidebar-footer">
                <div class="user-card" data-bs-toggle="dropdown">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'V', 0, 1) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Vendor' }}</div>
                        <div class="user-role">Vendor</div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="saas-main">
            <header class="saas-header">
                <button class="sidebar-toggle-btn" data-sidebar-toggle><i class="bi bi-list"></i></button>
                <div style="flex:1;"></div>
                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="user-avatar">{{ substr(Auth::user()->name ?? 'V', 0, 1) }}</div>
                        <div class="user-info-inline d-none d-md-block">
                            <div class="user-name">{{ Auth::user()->name ?? 'Vendor' }}</div>
                            <div class="user-role">Vendor</div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end saas-dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('vendor.profile') }}"><i class="bi bi-person"></i> Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </header>

            <div class="saas-content">
                @if(session('success'))
                    <div class="saas-alert saas-alert-success alert-dismissible">
                        <span class="alert-icon">✓</span>
                        <div class="alert-content">{{ session('success') }}</div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="saas-alert saas-alert-danger alert-dismissible">
                        <span class="alert-icon">✕</span>
                        <div class="alert-content">{{ session('error') }}</div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/saas-design-system.js') }}"></script>
    <script src="{{ asset('js/saas-loading.js') }}"></script>
    @stack('scripts')
</body>
</html>
