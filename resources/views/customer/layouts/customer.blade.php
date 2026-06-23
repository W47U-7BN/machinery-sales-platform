<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'Portal') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saas-loading.css') }}">
    <style>
        .portal-sidebar { background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
        .portal-sidebar .nav-link.active { background: rgba(59,130,246,0.15); color: #60a5fa; }
        .portal-header { background: var(--ds-surface); border-bottom: 1px solid var(--ds-border); }
    </style>
    @stack('styles')
</head>
<body>
    <div id="saas-preloader">
        <div class="saas-preloader-logo">
            <div class="logo-ring"></div>
            <div class="logo-icon">P</div>
        </div>
        <div class="saas-preloader-bars">
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
        </div>
        <div class="saas-preloader-text">Loading portal...</div>
        <div class="saas-preloader-progress"><div class="progress-fill"></div></div>
    </div>

    <div class="saas-toast-container"></div>

    <div id="saas-wrapper">
        <div class="saas-sidebar-overlay" data-sidebar-overlay></div>

        <aside class="saas-sidebar portal-sidebar" id="saas-sidebar">
            <a href="{{ route('customer.dashboard') }}" class="saas-sidebar-brand">
                <div class="brand-logo">P</div>
                <div class="brand-text">
                    <span class="brand-name">Customer Portal</span>
                    <span class="brand-sub">{{ config('app.name') }}</span>
                </div>
            </a>
            <nav class="saas-sidebar-menu">
                <div class="menu-label">Menu</div>
                <div class="nav-item">
                    <a href="{{ route('customer.dashboard') }}" class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.orders.index') }}" class="nav-link {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam nav-icon"></i>
                        <span class="nav-text">Pesanan</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.quotations.index') }}" class="nav-link {{ request()->routeIs('customer.quotations.*') ? 'active' : '' }}">
                        <i class="bi bi-file-text nav-icon"></i>
                        <span class="nav-text">Penawaran</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.invoices.index') }}" class="nav-link {{ request()->routeIs('customer.invoices.*') ? 'active' : '' }}">
                        <i class="bi bi-receipt nav-icon"></i>
                        <span class="nav-text">Invoice</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.service-tickets.index') }}" class="nav-link {{ request()->routeIs('customer.service-tickets.*') ? 'active' : '' }}">
                        <i class="bi bi-wrench nav-icon"></i>
                        <span class="nav-text">Service</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.downloads.index') }}" class="nav-link {{ request()->routeIs('customer.downloads.*') ? 'active' : '' }}">
                        <i class="bi bi-download nav-icon"></i>
                        <span class="nav-text">Download</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('customer.chat.index') }}" class="nav-link {{ request()->routeIs('customer.chat.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots nav-icon"></i>
                        <span class="nav-text">Chat</span>
                    </a>
                </div>
            </nav>
            <div class="saas-sidebar-footer">
                <div class="user-card" data-bs-toggle="dropdown">
                    <div class="user-avatar">{{ substr(Auth::user()->name ?? 'C', 0, 1) }}</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Customer' }}</div>
                        <div class="user-role">Customer</div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="saas-main">
            <header class="saas-header">
                <button class="sidebar-toggle-btn" data-sidebar-toggle>
                    <i class="bi bi-list"></i>
                </button>
                <div style="flex:1;"></div>
                <div class="dropdown user-dropdown">
                    <button class="dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="user-avatar">{{ substr(Auth::user()->name ?? 'C', 0, 1) }}</div>
                        <div class="user-info-inline d-none d-md-block">
                            <div class="user-name">{{ Auth::user()->name ?? 'Customer' }}</div>
                            <div class="user-role">Customer</div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end saas-dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="bi bi-person"></i> Profil</a></li>
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
