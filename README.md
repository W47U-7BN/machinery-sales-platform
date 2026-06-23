<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-red?logo=laravel&logoColor=white" alt="Laravel 12">
    <img src="https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white" alt="PHP 8.4">
    <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white" alt="MySQL">
    <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Livewire-4-fb70a9?logo=livewire&logoColor=white" alt="Livewire 4">
    <img src="https://img.shields.io/badge/license-MIT-blue" alt="MIT License">
</p>

# Perusahaan Mesin — ERP & E-Commerce Platform

> **Industrial Machinery B2B ERP System** — Platform manajemen penjualan, inventori, CRM, dan layanan purna jual untuk distributor mesin industri.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Screenshots](#screenshots)
- [Technology Stack](#technology-stack)
- [Architecture](#architecture)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [Project Structure](#project-structure)
- [Usage & Roles](#usage--roles)
- [API Reference](#api-reference)
- [Development](#development)
- [Security](#security)
- [Deployment](#deployment)
- [Roadmap](#roadmap)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

---

## Overview

**Perusahaan Mesin** adalah aplikasi ERP (Enterprise Resource Planning) berbasis web yang dirancang khusus untuk distributor mesin industri B2B. Platform ini mengintegrasikan seluruh operasi bisnis dalam satu sistem:

- **Public Website** — Landing page, katalog produk, artikel, testimoni, FAQ, dan form konsultasi/penawaran.
- **Customer Portal** — Pelanggan dapat melihat riwayat pesanan, quotation, invoice, dan membuat tiket layanan.
- **Dealer Portal** — Dealer dapat mengelola produk, komisi, target penjualan, dan memesan stok.
- **Vendor Portal** — Supplier/vendor dapat mengelola produk, purchase request, dan pembayaran.
- **Admin Dashboard** — Manajemen penuh: produk, inventori, pesanan, keuangan, CRM, HR, konten, dan laporan.
- **REST API** — Endpoint untuk integrasi eksternal dan aplikasi mobile.

### Masalah yang Diselesaikan

- Pengelolaan penjualan dan quotation yang masih manual dan terpisah
- Tidak adanya visibilitas stok secara real-time
- Pelacakan layanan purna jual (service ticket) yang tidak terstruktur
- Manajemen relasi pelanggan (CRM) yang belum terpusat
- Proses procurement (pembelian) yang tidak terdokumentasi
- Multi-level channel (dealer, vendor) tanpa sistem terintegrasi

### Target Pengguna

| Role | Deskripsi |
|------|-----------|
| Admin/Staff | Manajemen operasional bisnis penuh |
| Customer | Pembeli mesin industri (B2B) |
| Dealer | Mitra penjualan resmi |
| Vendor | Pemasok / supplier produk |

---

## Features

### Public Website
- Landing page profesional dengan hero, stats, kategori produk, testimoni
- Katalog produk dengan filter, pencarian, dan detail spesifikasi
- Blog/artikel dengan kategori dan pencarian
- Manajemen FAQ, testimoni, klien
- Form konsultasi teknis gratis
- Form permintaan penawaran harga
- Form pendaftaran newsletter
- Halaman karir dan lamaran pekerjaan
- Pusat unduhan (katalog, brosur, manual)
- Pencarian global (Laravel Scout)
- Breadcrumb navigasi
- Dark/Light mode
- WhatsApp floating button
- Responsive design (Tailwind CSS)
- SEO metadata (Spatie-like custom system)

### Customer Portal
- Dashboard dengan ringkasan pesanan dan quotation
- Riwayat pesanan dan detail status
- Riwayat quotation (penawaran harga)
- Invoice dan download PDF
- Pembuatan tiket layanan purna jual
- Pusat unduhan dokumen
- Chat dengan tim support
- Manajemen profil

### Admin Dashboard
- **Dashboard Analytics** — Grafik penjualan, revenue, leads, produk terlaris
- **Produk** — CRUD produk, gambar, video, dokumen, FAQ, atribut, review
- **Kategori & Brand** — Manajemen kategori dan brand produk
- **Pelanggan** — Manajemen data customer B2B
- **Leads** — Manajemen prospek penjualan dengan konversi ke customer
- **Quotation** — Pembuatan, approval, PDF quotation
- **Pesanan** — Manajemen pesanan, status, pengiriman
- **Invoice & Pembayaran** — Faktur dan pencatatan pembayaran
- **Inventory** — Stok, gudang, rak, transfer stok, mutasi
- **Supplier** — Manajemen pemasok produk
- **Purchase Order** — Pembelian dari supplier
- **Purchase Receiving** — Penerimaan barang pembelian
- **Service Ticket** — Tiket layanan, assignment, penyelesaian
- **Project** — Manajemen proyek dengan task dan dependensi
- **HR** — Departemen, posisi, karyawan
- **CMS** — Artikel, FAQ, testimoni, klien, karir
- **Marketing** — Campaign newsletter, subscriber management
- **Users & Roles** — Manajemen pengguna dengan RBAC (Spatie Permission)
- **Settings** — Konfigurasi sistem dan perusahaan
- **Reports** — Laporan penjualan, keuangan, inventori (export)
- **Dealer Management** — Manajemen mitra dealer
- **Vendor Management** — Manajemen pemasok/vendor
- **Document Management** — Manajemen dokumen internal
- **Activity Log** — Audit trail seluruh aktivitas (Spatie Activitylog)

### Dealer Portal
- Dashboard penjualan
- Manajemen produk dealer
- Riwayat pesanan
- Komisi penjualan
- Target penjualan
- Unduh dokumen

### Vendor Portal
- Dashboard
- Manajemen produk vendor
- Purchase request
- Riwayat pembayaran

### REST API
- Autentikasi (login, register, forgot/reset password)
- Produk, kategori, artikel (publik)
- Search endpoint
- Contact form submission
- Leads, quotations, orders (authenticated)
- Customers, service tickets
- Inventory (low stock, movements)
- Dashboard stats, revenue, sales

---

## Screenshots

```
+----------------------------------+
|         Landing Page              |
|  [ Hero Section ] [ Stats ]       |
|  [ Categories ] [ Products ]      |
|  [ Testimonials ] [ Blog ]        |
|  [ Newsletter ] [ Footer ]        |
+----------------------------------+
```

```
+----------------------------------+
|         Admin Dashboard           |
|  [ Revenue Chart ] [ Stats ]      |
|  [ Recent Orders ] [ Leads ]      |
|  [ Top Products ] [ Activity ]    |
+----------------------------------+
```

```
+----------------------------------+
|         Product Catalog           |
|  [ Filters ] [ Search ]           |
|  [ Product Grid ] [ Pagination ]  |
+----------------------------------+
```

```
+----------------------------------+
|         Customer Portal           |
|  [ Order History ] [ Quotations ] |
|  [ Invoices ] [ Service Tickets ] |
|  [ Downloads ] [ Chat ]           |
+----------------------------------+
```

```
+----------------------------------+
|         Quotation Management      |
|  [ Line Items ] [ Pricing ]       |
|  [ PDF Export ] [ Approve/Reject ]|
+----------------------------------+
```

```
+----------------------------------+
|         Inventory Management      |
|  [ Warehouse ] [ Stock Levels ]   |
|  [ Transfer ] [ Movements Log ]   |
+----------------------------------+
```

---

## Technology Stack

### Backend
| Teknologi | Kegunaan |
|-----------|----------|
| **Laravel 12** | Framework utama |
| **PHP 8.4** | Bahasa pemrograman |
| **Laravel Fortify** | Autentikasi backend (2FA, reset password) |
| **Laravel Breeze** | Scaffolding autentikasi Blade |
| **Laravel Sanctum** | API token authentication |
| **Laravel Scout** | Full-text search engine |
| **Spatie Laravel Permission** | RBAC (Role-Based Access Control) |
| **Spatie Laravel Activitylog** | Activity logging / audit trail |
| **Spatie Laravel Medialibrary** | Manajemen media dan file upload |
| **Livewire 4** | Komponen interaktif tanpa JavaScript |
| **Jenssegers Agent** | Deteksi browser/device |

### Frontend
| Teknologi | Kegunaan |
|-----------|----------|
| **Blade** | Template engine |
| **Tailwind CSS 3** | Utility-first CSS framework |
| **Alpine.js** | Interaktivitas ringan di frontend |
| **Vite** | Build tool / bundler |
| **Font Awesome** | Ikon |
| **Bootstrap Icons** | Ikon tambahan |

### Database
| Teknologi | Kegunaan |
|-----------|----------|
| **MySQL 8.0** | Database utama |
| **Laravel Migrations** | Version control database |
| **Laravel Factories** | Data seeding development |
| **Laravel Seeders** | Data awal aplikasi |

### Tools & Infrastructure
| Teknologi | Kegunaan |
|-----------|----------|
| **Composer** | PHP dependency manager |
| **npm** | Node.js dependency manager |
| **Git** | Version control |
| **PHPUnit** | Testing framework |
| **Laravel Pint** | PHP code style fixer |
| **Laravel Sail** | Docker development environment |

---

## Architecture

### Pattern: Repository + Service Layer

```
Route → Controller → Service → Repository → Model → Database
                        ↓
                   DTO (Data Transfer Object)
```

Aplikasi menggunakan **Repository Pattern** dengan **Service Layer**:

- **Controllers** — Menangani request/response, validasi
- **Services** — Business logic, orchestration
- **Repositories** — Data access layer (query database)
- **Contracts/Interfaces** — Abstraksi untuk setiap repository dan service
- **DTOs** — Objek transfer data untuk menghindari mass assignment issues
- **Traits** — Fungsionalitas reusable (HasMedia, HasSEO, HasSlug, HasStatus, dll)
- **Enums** — State machine untuk status (OrderStatus, LeadStatus, PaymentStatus, dll)
- **Policies** — Authorization logic per model

### Multi-Portal Structure

```
Single App — 4 Auth Systems + API
    ├── Public (Guest)
    ├── Admin (auth)
    ├── Customer (auth)
    ├── Dealer (auth)
    ├── Vendor (auth)
    └── API (auth:sanctum)
```

---

## Installation

### Prerequisites

- PHP 8.2+
- Composer 2.x
- MySQL 8.0+
- Node.js 18+ & npm
- Git

### Step-by-Step

```bash
# 1. Clone repository
git clone https://github.com/W47U-7BN/perusahaan-mesin.git
cd perusahaan-mesin

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Copy environment file
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Configure database in .env (see Environment Setup below)

# 7. Run database migrations
php artisan migrate

# 8. Seed database with initial data
php artisan db:seed

# 9. Create storage symlink
php artisan storage:link

# 10. Build frontend assets
npm run build

# 11. Run application
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

---

## Environment Setup

Buka file `.env` dan sesuaikan konfigurasi berikut:

### Database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perusahaan_mesin
DB_USERNAME=root
DB_PASSWORD=
```

### Mail

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@perusahaanmesin.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Scout (Search)

```env
SCOUT_DRIVER=database
# Or use Meilisearch:
# SCOUT_DRIVER=meilisearch
# MEILISEARCH_HOST=http://localhost:7700
# MEILISEARCH_KEY=masterKey
```

### Application

```env
APP_NAME="Perusahaan Mesin"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

### Session & Cache

```env
SESSION_DRIVER=file
# Use database for multi-server:
# SESSION_DRIVER=database
CACHE_STORE=file
```

### Filesystem

```env
FILESYSTEM_DISK=local
```

### Fortify (Auth)

```env
FORTIFY_FEATURES=['two-factor-authentication']
```

---

## Project Structure

```
perusahaan-mesin/
├── app/
│   ├── Casts/                     # Custom Eloquent casts
│   ├── Console/                   # Artisan commands
│   ├── Contracts/
│   │   ├── Repositories/          # Repository interfaces (abstractions)
│   │   └── Services/              # Service interfaces (abstractions)
│   ├── DTOs/                      # Data Transfer Objects
│   ├── Enums/                     # State machine enums
│   ├── Exceptions/                # Custom exceptions
│   ├── Helpers/                   # Helper functions
│   ├── Http/
│   │   ├── Controllers/           # All controllers (Admin, Customer, Dealer, Vendor, Api)
│   │   ├── Middleware/             # Custom middleware (Admin, AuditTrail, IpRestriction, etc.)
│   │   └── Requests/              # Form request validation
│   ├── Models/                    # 84 Eloquent models
│   ├── Policies/                  # Authorization policies
│   ├── Providers/                 # Service providers
│   ├── Repositories/              # Data access layer
│   ├── Services/                  # Business logic layer
│   ├── Traits/                    # Reusable traits
│   └── View/                      # Blade view components
├── bootstrap/                     # Laravel bootstrap files
├── config/                        # Configuration files (16 files)
├── database/
│   ├── factories/                 # Model factories (25 files)
│   ├── migrations/                # Database migrations (88 files)
│   └── seeders/                   # Database seeders (23 files)
├── public/
│   ├── build/                     # Vite build output
│   ├── css/                       # Static CSS (landing.css, design system)
│   └── js/                        # Static JS (landing.js)
├── resources/
│   ├── css/                       # Tailwind source CSS
│   ├── js/                        # Alpine.js, Axios, app.js
│   └── views/                     # Blade templates (150+ files)
│       ├── admin/                 # Admin dashboard views
│       ├── customer/              # Customer portal views
│       ├── dealer/                # Dealer portal views
│       ├── vendor/                # Vendor portal views
│       ├── landing/               # Public landing pages
│       ├── layouts/               # Layout templates
│       ├── partials/              # Shared partials
│       └── components/            # Blade components
├── routes/
│   ├── web.php                    # Public frontend routes
│   ├── auth.php                   # Auth routes (Fortify/Breeze)
│   ├── admin.php                  # Admin dashboard routes
│   ├── customer.php               # Customer portal routes
│   ├── dealer.php                 # Dealer portal routes
│   ├── vendor.php                 # Vendor portal routes
│   ├── api.php                    # REST API routes
│   └── console.php                # Artisan console commands
├── storage/                       # Laravel storage (logs, cache, uploads)
├── vendor/                        # Composer packages
├── composer.json
├── package.json
├── vite.config.js
└── tailwind.config.js
```

---

## Usage & Roles

### Public User (Guest)

Mengakses website publik tanpa login:

- Melihat landing page, katalog produk, artikel, testimoni, FAQ
- Mengirim form konsultasi dan permintaan penawaran
- Mendaftar newsletter
- Melihat dan melamar lowongan karir
- Mengunduh brosur/dokumen

### Customer

Login di `/customer/login`:

- Dashboard dengan ringkasan aktivitas
- Manajemen profil
- Riwayat pesanan dan status pengiriman
- Riwayat quotation dan approval
- Invoice dan download PDF
- Tiket layanan purna jual
- Pusat unduhan dokumen
- Chat dengan tim support

### Dealer

Login di `/dealer/login`:

- Dashboard penjualan
- Manajemen produk dealer
- Riwayat pesanan
- Komisi penjualan
- Target penjualan
- Unduh dokumen marketing

### Vendor

Login di `/vendor/login`:

- Dashboard
- Manajemen produk vendor
- Purchase request dari perusahaan
- Riwayat pembayaran

### Admin

Login di `/login`:

- **Dashboard Analytics** — Revenue, sales, leads, top products charts
- **Produk** — Full CRUD, images, videos, documents, attributes, reviews
- **Kategori & Brand** — Manajemen kategori dan brand
- **Pelanggan** — Data customer B2B
- **Leads** — Prospek penjualan, konversi ke customer
- **Quotation** — Buat, approve, reject, export PDF
- **Pesanan** — Manajemen order dan status
- **Invoice & Payment** — Faktur dan pembayaran
- **Inventory** — Stok, gudang, transfer, mutasi
- **Supplier** — Manajemen pemasok
- **Purchase** — PO, receiving
- **Service Ticket** — Tiket layanan, assignment
- **Project** — Manajemen proyek
- **HR** — Departemen, posisi, karyawan
- **CMS** — Artikel, FAQ, testimoni, klien, karir
- **Marketing** — Campaign newsletter
- **Users & Roles** — RBAC dengan Spatie Permission
- **Settings** — Konfigurasi sistem
- **Reports** — Laporan dengan export
- **Dealer & Vendor Management**
- **Document Management**
- **Activity Log** — Audit trail

---

## API Reference

### Public Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/auth/login` | Login pengguna |
| POST | `/api/auth/register` | Registrasi pengguna |
| POST | `/api/auth/forgot-password` | Lupa password |
| POST | `/api/auth/reset-password` | Reset password |
| GET | `/api/products` | Daftar produk |
| GET | `/api/products/{slug}` | Detail produk |
| GET | `/api/categories` | Daftar kategori |
| GET | `/api/categories/{slug}` | Detail kategori |
| GET | `/api/articles` | Daftar artikel |
| GET | `/api/articles/{slug}` | Detail artikel |
| POST | `/api/contact` | Kirim form kontak |
| GET | `/api/search` | Pencarian global |

### Authenticated Endpoints

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| POST | `/api/auth/logout` | Logout |
| GET | `/api/auth/me` | Profil pengguna |
| PUT | `/api/auth/profile` | Update profil |
| GET/POST/PUT/DELETE | `/api/leads` | CRUD leads |
| GET/POST/PUT/DELETE | `/api/quotations` | CRUD quotations |
| POST | `/api/quotations/{id}/approve` | Approve quotation |
| POST | `/api/quotations/{id}/reject` | Reject quotation |
| GET/POST/PUT/DELETE | `/api/orders` | CRUD orders |
| GET/POST/PUT/DELETE | `/api/customers` | CRUD customers |
| GET/POST/PUT/DELETE | `/api/service-tickets` | CRUD service tickets |
| GET | `/api/inventory` | Data inventory |
| GET | `/api/inventory/low-stock` | Stok menipis |
| GET | `/api/dashboard/stats` | Statistik dashboard |
| GET | `/api/dashboard/revenue` | Data revenue |
| GET | `/api/dashboard/leads` | Data leads |
| GET | `/api/dashboard/sales` | Data penjualan |

---

## Development

### Menjalankan Aplikasi

```bash
# Development server
php artisan serve

# Build assets for development
npm run dev

# Build assets for production
npm run build

# Watch assets
npm run watch
```

### Menambah Fitur Baru

1. Buat migration: `php artisan make:migration create_xxx_table`
2. Buat model: `php artisan make:model Models/Xxx`
3. Buat controller: `php artisan make:controller XxxController`
4. Buat repository interface di `app/Contracts/Repositories/`
5. Buat repository implementasi di `app/Repositories/`
6. Buat service di `app/Services/`
7. Daftarkan binding di `AppServiceProvider`
8. Buat views di `resources/views/`
9. Tambahkan route di file route yang sesuai

### Database

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Seed database
php artisan db:seed

# Seed specific seeder
php artisan db:seed --class=ProductSeeder

# Reset database
php artisan migrate:fresh --seed
```

### Cache

```bash
# Clear all cache
php artisan optimize:clear

# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Cache events
php artisan event:cache
```

### Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=ProductTest

# Run PHPUnit directly
vendor/bin/phpunit
```

### Code Style

```bash
# Check code style
./vendor/bin/pint --test

# Fix code style
./vendor/bin/pint
```

---

## Security

- **Jangan commit `.env`** — File environment berisi kredensial database, API keys, dan APP_KEY
- **Jangan expose `APP_KEY`** — Key digunakan untuk enkripsi session, cookie, dan data
- **Gunakan HTTPS** — Selalu gunakan HTTPS di production untuk enkripsi data
- **Rotate API tokens** — Sanctum tokens harus dirotasi secara berkala
- **RBAC** — Gunakan Spatie Permission untuk mengontrol akses setiap role
- **Validate input** — Semua input divalidasi melalui Form Request
- **CSRF Protection** — Aktif untuk semua web routes
- **XSS Prevention** — Blade auto-escapes output, hindari `{!! !!}` tanpa sanitasi
- **SQL Injection** — Eloquent ORM menggunakan parameter binding
- **Rate Limiting** — Terapkan rate limiting pada API endpoints
- **Activity Log** — Semua operasi kritis tercatat untuk audit trail

---

## Deployment

### Production Checklist

```bash
# 1. Set environment
APP_ENV=production
APP_DEBUG=false

# 2. Optimize Laravel
php artisan optimize

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 3. Build frontend assets
npm run build

# 4. Storage link
php artisan storage:link

# 5. Set permissions (Linux)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Server Requirements

- PHP 8.2+ dengan extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, MySQL
- MySQL 8.0+
- Apache/Nginx with mod_rewrite
- Composer (for updates)

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name perusahaanmesin.com;
    root /var/www/perusahaan-mesin/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Roadmap

### ✅ Completed
- [x] Public landing page dan katalog produk
- [x] Admin dashboard dengan analytics
- [x] Manajemen produk, kategori, brand
- [x] CRM (Leads & Customers)
- [x] Quotation dan approval workflow
- [x] Order management
- [x] Invoice dan payment tracking
- [x] Inventory management multi-gudang
- [x] Purchase order dan receiving
- [x] Service ticket management
- [x] Project management
- [x] HR (employee, department, position)
- [x] CMS (articles, FAQ, testimonials, clients, careers)
- [x] Marketing (newsletter campaigns)
- [x] RBAC (Spatie Permission)
- [x] REST API
- [x] Customer portal
- [x] Dealer portal
- [x] Vendor portal
- [x] Multi-level auth (Admin, Customer, Dealer, Vendor)
- [x] SEO metadata management
- [x] Activity logging / audit trail
- [x] Media library (image/video/document upload)
- [x] Search functionality (Laravel Scout)

### 🔄 In Progress
- [ ] E-commerce cart & checkout flow
- [ ] Wishlist and product reviews
- [ ] Real-time chat system
- [ ] Shipping tracking integration
- [ ] Mobile app (via API)

### 📋 Planned
- [ ] Multi-language support
- [ ] Advanced reporting & BI dashboard
- [ ] Automated email notifications
- [ ] Integration with payment gateway
- [ ] Integration with logistics API
- [ ] Warehouse barcode scanning
- [ ] POS (Point of Sale) module
- [ ] Procurement forecasting
- [ ] Customer loyalty program
- [ ] Vendor rating system

---

## Contributing

Kontribusi sangat diterima! Silakan ikuti panduan berikut:

1. **Fork** repository ini
2. Buat **branch fitur** baru: `git checkout -b feature/amazing-feature`
3. **Commit** perubahan: `git commit -m 'feat: add amazing feature'`
4. **Push** ke branch: `git push origin feature/amazing-feature`
5. Buat **Pull Request**

### Git Commit Convention

Gunakan [Conventional Commits](https://www.conventionalcommits.org/):

- `feat:` — Fitur baru
- `fix:` — Perbaikan bug
- `refactor:` — Refaktor kode
- `style:` — Perubahan style (formatting, whitespace)
- `docs:` — Dokumentasi
- `test:` — Testing
- `chore:` — Maintenance, dependencies

### Development Guidelines

- Ikuti **Repository + Service Pattern** yang sudah ada
- Tambahkan **interface** untuk setiap repository dan service baru
- Gunakan **DTOs** untuk data transfer antar layer
- Gunakan **Enums** untuk state machine, bukan string constants
- Tambahkan **Policy** untuk authorization
- Tulis **factory** dan **seeder** untuk model baru
- Pastikan `npm run build` tidak error
- Pastikan `php artisan optimize:clear` tidak error

---

## License

MIT License

Copyright (c) 2026 Muhammad Nur Wahid

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

---

## Author

**Muhammad Nur Wahid**

- GitHub: [@W47U-7BN](https://github.com/W47U-7BN)
- Website: [perusahaanmesin.com](https://perusahaanmesin.com)

---

<p align="center">
    Dibangun dengan ❤️ menggunakan <a href="https://laravel.com">Laravel</a>,
    <a href="https://tailwindcss.com">Tailwind CSS</a>, dan <a href="https://alpinejs.dev">Alpine.js</a>
</p>
