<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — {{ config('app.name', 'ERP System') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Design System --}}
    <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/saas-loading.css') }}">

    {{-- Vendor CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css" rel="stylesheet">

    @stack('styles')
</head>
<body>
    {{-- Preloader --}}
    <div id="saas-preloader">
        <div class="saas-preloader-logo">
            <div class="logo-ring"></div>
            <div class="logo-icon">M</div>
        </div>
        <div class="saas-preloader-bars">
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
            <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
        </div>
        <div class="saas-preloader-text">Loading your workspace...</div>
        <div class="saas-preloader-progress">
            <div class="progress-fill"></div>
        </div>
    </div>

    {{-- Toast Container --}}
    <div class="saas-toast-container"></div>

    {{-- Command Palette --}}
    <div class="saas-command-overlay" id="command-palette">
        <div class="saas-command-palette">
            <div class="saas-command-input-wrap">
                <i class="bi bi-search cmd-icon"></i>
                <input type="text" placeholder="Search menus and pages..." autocomplete="off" autofocus>
                <span style="font-size:11px;color:var(--ds-text-tertiary);background:var(--ds-surface-tertiary);padding:2px 6px;border-radius:4px;">ESC</span>
            </div>
            <div class="saas-command-results">
                <div class="saas-command-group-label">Navigation</div>
                <a href="{{ route('admin.dashboard') }}" class="saas-command-item" data-route="{{ route('admin.dashboard') }}">
                    <span class="cmd-item-icon"><i class="bi bi-house-door"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Dashboard</div>
                        <div class="cmd-item-desc">Main overview and statistics</div>
                    </span>
                </a>
                <a href="{{ route('admin.leads.index') }}" class="saas-command-item" data-route="{{ route('admin.leads.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-people"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">CRM — Leads</div>
                        <div class="cmd-item-desc">Manage customer leads</div>
                    </span>
                </a>
                <a href="{{ route('admin.customers.index') }}" class="saas-command-item" data-route="{{ route('admin.customers.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-person-badge"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">CRM — Customers</div>
                        <div class="cmd-item-desc">Manage customer accounts</div>
                    </span>
                </a>
                <a href="{{ route('admin.quotations.index') }}" class="saas-command-item" data-route="{{ route('admin.quotations.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-file-text"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Sales — Quotations</div>
                        <div class="cmd-item-desc">Manage sales quotations</div>
                    </span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="saas-command-item" data-route="{{ route('admin.orders.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-cart"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Sales — Orders</div>
                        <div class="cmd-item-desc">Manage customer orders</div>
                    </span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="saas-command-item" data-route="{{ route('admin.invoices.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-receipt"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Sales — Invoices</div>
                        <div class="cmd-item-desc">Manage invoices</div>
                    </span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="saas-command-item" data-route="{{ route('admin.products.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-box"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Products</div>
                        <div class="cmd-item-desc">Manage product catalog</div>
                    </span>
                </a>
                <a href="{{ route('admin.inventory.index') }}" class="saas-command-item" data-route="{{ route('admin.inventory.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-archive"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Inventory</div>
                        <div class="cmd-item-desc">Stock management</div>
                    </span>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="saas-command-item" data-route="{{ route('admin.reports.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-graph-up"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Reports</div>
                        <div class="cmd-item-desc">Analytics and reports</div>
                    </span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="saas-command-item" data-route="{{ route('admin.settings.index') }}">
                    <span class="cmd-item-icon"><i class="bi bi-gear"></i></span>
                    <span class="cmd-item-text">
                        <div class="cmd-item-label">Settings</div>
                        <div class="cmd-item-desc">System configuration</div>
                    </span>
                </a>
            </div>
        </div>
    </div>

    {{-- Main Wrapper --}}
    <div class="admin-wrapper" id="saas-wrapper">
        {{-- Sidebar Overlay (Mobile) --}}
        <div class="saas-sidebar-overlay" data-sidebar-overlay></div>

        {{-- Sidebar --}}
        <aside class="saas-sidebar" id="saas-sidebar">
            <a href="{{ route('admin.dashboard') }}" class="saas-sidebar-brand">
                <div class="brand-logo">M</div>
                <div class="brand-text">
                    <span class="brand-name">MachineryERP</span>
                    <span class="brand-sub">Enterprise System</span>
                </div>
            </a>

            <nav class="saas-sidebar-menu">
                <div class="menu-label">Main Menu</div>
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door-fill nav-icon"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>

                <div class="menu-label">CRM</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-crm" data-expanded="{{ request()->routeIs('admin.leads*') || request()->routeIs('admin.customers*') ? 'true' : 'false' }}">
                        <i class="bi bi-people-fill nav-icon"></i>
                        <span class="nav-text">CRM</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.leads*') || request()->routeIs('admin.customers*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.leads*') || request()->routeIs('admin.customers*') ? 'open' : '' }}" id="menu-crm">
                        <a href="{{ route('admin.leads.index') }}" class="nav-link {{ request()->routeIs('admin.leads*') ? 'active' : '' }}">Leads</a>
                        <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers*') ? 'active' : '' }}">Customers</a>
                    </div>
                </div>

                <div class="menu-label">Penjualan</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-sales" data-expanded="{{ request()->routeIs('admin.quotations*') || request()->routeIs('admin.orders*') || request()->routeIs('admin.invoices*') || request()->routeIs('admin.payments*') ? 'true' : 'false' }}">
                        <i class="bi bi-cart-fill nav-icon"></i>
                        <span class="nav-text">Penjualan</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.quotations*') || request()->routeIs('admin.orders*') || request()->routeIs('admin.invoices*') || request()->routeIs('admin.payments*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.quotations*') || request()->routeIs('admin.orders*') || request()->routeIs('admin.invoices*') || request()->routeIs('admin.payments*') ? 'open' : '' }}" id="menu-sales">
                        <a href="{{ route('admin.quotations.index') }}" class="nav-link {{ request()->routeIs('admin.quotations*') ? 'active' : '' }}">Quotations</a>
                        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">Orders</a>
                        <a href="{{ route('admin.invoices.index') }}" class="nav-link {{ request()->routeIs('admin.invoices*') ? 'active' : '' }}">Invoices</a>
                        <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments*') ? 'active' : '' }}">Payments</a>
                    </div>
                </div>

                <div class="menu-label">Produk</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-products" data-expanded="{{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') || request()->routeIs('admin.brands*') ? 'true' : 'false' }}">
                        <i class="bi bi-box-fill nav-icon"></i>
                        <span class="nav-text">Produk</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') || request()->routeIs('admin.brands*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.products*') || request()->routeIs('admin.categories*') || request()->routeIs('admin.brands*') ? 'open' : '' }}" id="menu-products">
                        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">Products</a>
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">Categories</a>
                        <a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}">Brands</a>
                    </div>
                </div>

                <div class="menu-label">Inventori</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-inventory" data-expanded="{{ request()->routeIs('admin.inventory*') || request()->routeIs('admin.warehouses*') ? 'true' : 'false' }}">
                        <i class="bi bi-archive-fill nav-icon"></i>
                        <span class="nav-text">Inventori</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.inventory*') || request()->routeIs('admin.warehouses*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.inventory*') || request()->routeIs('admin.warehouses*') ? 'open' : '' }}" id="menu-inventory">
                        <a href="{{ route('admin.inventory.index') }}" class="nav-link {{ request()->routeIs('admin.inventory*') ? 'active' : '' }}">Inventory</a>
                        <a href="{{ route('admin.warehouses.index') }}" class="nav-link {{ request()->routeIs('admin.warehouses*') ? 'active' : '' }}">Warehouses</a>
                        <a href="{{ route('admin.inventory.transfer') }}" class="nav-link {{ request()->routeIs('admin.inventory.transfer') ? 'active' : '' }}">Transfers</a>
                    </div>
                </div>

                <div class="menu-label">Pembelian</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-purchasing" data-expanded="{{ request()->routeIs('admin.suppliers*') || request()->routeIs('admin.purchase-orders*') ? 'true' : 'false' }}">
                        <i class="bi bi-truck nav-icon"></i>
                        <span class="nav-text">Pembelian</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.suppliers*') || request()->routeIs('admin.purchase-orders*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.suppliers*') || request()->routeIs('admin.purchase-orders*') ? 'open' : '' }}" id="menu-purchasing">
                        <a href="{{ route('admin.suppliers.index') }}" class="nav-link {{ request()->routeIs('admin.suppliers*') ? 'active' : '' }}">Suppliers</a>
                        <a href="{{ route('admin.purchase-orders.index') }}" class="nav-link {{ request()->routeIs('admin.purchase-orders*') ? 'active' : '' }}">Purchase Orders</a>
                    </div>
                </div>

                <div class="menu-label">Layanan</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-service" data-expanded="{{ request()->routeIs('admin.service-tickets*') || request()->routeIs('admin.projects*') ? 'true' : 'false' }}">
                        <i class="bi bi-wrench nav-icon"></i>
                        <span class="nav-text">Layanan</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.service-tickets*') || request()->routeIs('admin.projects*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.service-tickets*') || request()->routeIs('admin.projects*') ? 'open' : '' }}" id="menu-service">
                        <a href="{{ route('admin.service-tickets.index') }}" class="nav-link {{ request()->routeIs('admin.service-tickets*') ? 'active' : '' }}">Service Tickets</a>
                        <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">Projects</a>
                    </div>
                </div>

                <div class="menu-label">Marketing</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-marketing" data-expanded="{{ request()->routeIs('admin.campaigns*') || request()->routeIs('admin.newsletters*') || request()->routeIs('admin.articles*') || request()->routeIs('admin.testimonials*') ? 'true' : 'false' }}">
                        <i class="bi bi-megaphone-fill nav-icon"></i>
                        <span class="nav-text">Marketing</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.campaigns*') || request()->routeIs('admin.newsletters*') || request()->routeIs('admin.articles*') || request()->routeIs('admin.testimonials*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.campaigns*') || request()->routeIs('admin.newsletters*') || request()->routeIs('admin.articles*') || request()->routeIs('admin.testimonials*') ? 'open' : '' }}" id="menu-marketing">
                        <a href="{{ route('admin.campaigns.index') }}" class="nav-link {{ request()->routeIs('admin.campaigns*') ? 'active' : '' }}">Campaigns</a>
                        <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters*') ? 'active' : '' }}">Newsletter</a>
                        <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles*') ? 'active' : '' }}">Articles</a>
                        <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">Testimonials</a>
                    </div>
                </div>

                <div class="menu-label">SDM</div>
                <div class="nav-item">
                    <a href="{{ route('admin.employees.index') }}" class="nav-link {{ request()->routeIs('admin.employees*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge nav-icon"></i>
                        <span class="nav-text">Karyawan</span>
                    </a>
                </div>

                <div class="menu-label">Finance</div>
                <div class="nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <i class="bi bi-graph-up-arrow nav-icon"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </div>

                <div class="menu-label">System</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" data-submenu-toggle="#menu-settings" data-expanded="{{ request()->routeIs('admin.settings*') || request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') || request()->routeIs('admin.media*') || request()->routeIs('admin.documents*') ? 'true' : 'false' }}">
                        <i class="bi bi-gear-fill nav-icon"></i>
                        <span class="nav-text">Pengaturan</span>
                        <i class="bi bi-chevron-right nav-arrow {{ request()->routeIs('admin.settings*') || request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') || request()->routeIs('admin.media*') || request()->routeIs('admin.documents*') ? 'open' : '' }}"></i>
                    </a>
                    <div class="saas-sidebar-submenu {{ request()->routeIs('admin.settings*') || request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') || request()->routeIs('admin.media*') || request()->routeIs('admin.documents*') ? 'open' : '' }}" id="menu-settings">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">Settings</a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">Users</a>
                        <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles*') ? 'active' : '' }}">Roles</a>
                        <a href="{{ route('admin.media.index') }}" class="nav-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}">Media</a>
                        <a href="{{ route('admin.documents.index') }}" class="nav-link {{ request()->routeIs('admin.documents*') ? 'active' : '' }}">Documents</a>
                    </div>
                </div>
            </nav>

            <div class="saas-sidebar-footer">
                <div class="user-card" data-bs-toggle="dropdown">
                    <div class="user-avatar">A</div>
                    <div class="user-info">
                        <div class="user-name">{{ Auth::user()->name ?? 'Admin User' }}</div>
                        <div class="user-role">{{ Auth::user()->roles->first()->name ?? 'Super Admin' }}</div>
                    </div>
                    <i class="bi bi-three-dots-vertical" style="color:rgba(255,255,255,0.3);font-size:14px;"></i>
                </div>
                <div class="dropdown-menu saas-dropdown-menu" style="position:absolute;bottom:100%;left:10px;">
                    <a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> My Profile</a>
                    <a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
                <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="saas-main">
            {{-- Header --}}
            <header class="saas-header">
                <button class="sidebar-toggle-btn" data-sidebar-toggle>
                    <i class="bi bi-list"></i>
                </button>

                <div class="header-search d-none d-md-block" data-search-trigger data-command-palette>
                    <div class="search-trigger">
                        <i class="bi bi-search search-icon" style="position:static;transform:none;color:var(--ds-text-tertiary);font-size:14px;"></i>
                        <span class="search-placeholder">Search anything...</span>
                        <span class="search-shortcut">Ctrl+K</span>
                    </div>
                </div>

                <div class="header-actions">
                    <button class="btn-icon" data-theme-toggle title="Toggle Dark Mode">
                        <i class="bi bi-moon-stars-fill theme-icon-moon" id="theme-toggle-icon" style="display:block;"></i>
                        <i class="bi bi-sun-fill theme-icon-sun" style="display:none;"></i>
                    </button>
                    <button class="btn-icon position-relative" title="Notifications">
                        <i class="bi bi-bell-fill"></i>
                        <span class="notif-count">3</span>
                    </button>
                    <div class="dropdown user-dropdown">
                        <button class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <span>{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="user-info-inline d-none d-md-block">
                                <div class="user-name">{{ Auth::user()->name ?? 'Admin User' }}</div>
                                <div class="user-role">{{ Auth::user()->roles->first()->name ?? 'Super Admin' }}</div>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end saas-dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Account Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            {{-- Content Area --}}
            <div class="saas-content">
                <div class="saas-page-header">
                    <div class="page-title-area">
                        <h4>@yield('page-title', 'Dashboard')</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                @section('breadcrumbs')
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @show
                                @yield('breadcrumb-items')
                            </ol>
                        </nav>
                    </div>
                    <div class="saas-page-actions">
                        @yield('page-actions')
                    </div>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="saas-alert saas-alert-success alert-dismissible" role="alert">
                        <span class="alert-icon">✓</span>
                        <div class="alert-content">
                            <div class="alert-title">Success</div>
                            {{ session('success') }}
                        </div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="saas-alert saas-alert-danger alert-dismissible" role="alert">
                        <span class="alert-icon">✕</span>
                        <div class="alert-content">
                            <div class="alert-title">Error</div>
                            {{ session('error') }}
                        </div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif

                @yield('content')
            </div>

            {{-- Footer --}}
            <footer class="saas-footer">
                <span>&copy; {{ date('Y') }} {{ config('app.name', 'MachineryERP') }}. All rights reserved.</span>
                <span>v1.0.0</span>
            </footer>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    {{-- Design System JS --}}
    <script src="{{ asset('js/saas-design-system.js') }}"></script>
    <script src="{{ asset('js/saas-loading.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2
            if (typeof $.fn.select2 !== 'undefined') {
                $.fn.select2.defaults.set('theme', 'bootstrap-5');
                $('.select2').select2();
            }

            // Logout forms
            window.logout = function() {
                document.getElementById('logout-form-header').submit();
            };
        });

        // Delete confirmation
        function confirmDelete(url, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus ' + (name || 'data ini') + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';
                    const csrf = document.createElement('input');
                    csrf.name = '_token';
                    csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                    form.appendChild(csrf);
                    const method = document.createElement('input');
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
            return false;
        }

        // Toast helper
        function showToast(message, type) {
            if (window.SaaS) {
                SaaS.showToast({ title: message, type: type || 'info' });
            } else {
                Swal.fire({ toast: true, position: 'top-end', icon: type || 'info', title: message, showConfirmButton: false, timer: 3000, timerProgressBar: true });
            }
        }

        // Export table
        function exportTable(type) {
            const table = document.querySelector('.saas-table, .data-table');
            if (!table) return;
            let csv = [];
            const rows = table.querySelectorAll('tr');
            for (const row of rows) {
                const cols = row.querySelectorAll('td, th');
                const vals = [];
                for (const col of cols) {
                    let text = col.innerText.replace(/,/g, ' ').replace(/\n/g, ' ').trim();
                    vals.push('"' + text + '"');
                }
                csv.push(vals.join(','));
            }
            const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'export_' + Date.now() + '.csv';
            link.click();
        }
    </script>
    @stack('scripts')
</body>
</html>
