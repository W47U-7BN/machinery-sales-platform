@extends('layouts.landing')

@section('title', 'Katalog Produk - Mesin Industri & Alat Berat')
@section('meta_description', 'Jelajahi katalog lengkap mesin industri dan alat berat kami. Temukan produk berkualitas untuk kebutuhan bisnis Anda.')

@section('content')
<section class="lp-dark-section" style="padding:140px 0 80px;">
    <div class="lp-container">
        @include('partials.breadcrumb', ['items' => [['label' => 'Produk']]])
        <h1 class="lp-title" style="color:white;margin-top:16px;">Katalog Produk</h1>
        <p style="color:rgba(255,255,255,0.6);font-size:18px;max-width:560px;">Jelajahi ribuan produk mesin industri dan alat berat berkualitas global</p>
    </div>
</section>

<section class="lp-section lp-gray-section">
    <div class="lp-container">
        <div style="display:flex;gap:32px;">
            <aside style="width:280px;flex-shrink:0;display:none;" class="lg:block" x-data="{ mobileFilterOpen: false }">
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <div class="lp-feature-card" style="padding:24px;">
                        <h3 style="font-size:15px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-tags" style="color:var(--lp-secondary);font-size:13px;"></i>
                            <span>Kategori</span>
                        </h3>
                        <div style="display:flex;flex-direction:column;gap:8px;">
                            @php $cats = ['Semua Kategori', 'Mesin Konstruksi', 'Mesin Pertanian', 'Mesin Manufaktur', 'Mesin Energi', 'Mesin Pengolahan', 'Sistem Otomasi', 'Alat Berat', 'Suku Cadang']; @endphp
                            @foreach($cats as $cat)
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                                <input type="checkbox" style="width:16px;height:16px;accent-color:var(--lp-primary);">
                                <span style="font-size:14px;color:var(--lp-gray-600);">{{ $cat }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="lp-feature-card" style="padding:24px;">
                        <h3 style="font-size:15px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-tag" style="color:var(--lp-secondary);font-size:13px;"></i>
                            <span>Brand</span>
                        </h3>
                        <div style="display:flex;flex-direction:column;gap:8px;">
                            @php $brands = ['Komatsu', 'Caterpillar', 'Hitachi', 'Volvo', 'Doosan', 'Hyundai', 'Liebherr', 'Sany']; @endphp
                            @foreach($brands as $brand)
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                                <input type="checkbox" style="width:16px;height:16px;accent-color:var(--lp-primary);">
                                <span style="font-size:14px;color:var(--lp-gray-600);">{{ $brand }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="lp-feature-card" style="padding:24px;">
                        <h3 style="font-size:15px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-rupiah-sign" style="color:var(--lp-secondary);font-size:13px;"></i>
                            <span>Rentang Harga</span>
                        </h3>
                        <div style="display:flex;flex-direction:column;gap:12px;">
                            <div>
                                <label style="font-size:12px;color:var(--lp-gray-500);">Harga Minimum</label>
                                <input type="number" placeholder="Rp 0" class="lp-input" style="margin-top:4px;">
                            </div>
                            <div>
                                <label style="font-size:12px;color:var(--lp-gray-500);">Harga Maksimum</label>
                                <input type="number" placeholder="Rp 999.999.999" class="lp-input" style="margin-top:4px;">
                            </div>
                            <button style="padding:10px;width:100%;background:var(--lp-primary);color:white;font-size:14px;font-weight:600;border:none;border-radius:var(--lp-radius-md);cursor:pointer;">Terapkan</button>
                        </div>
                    </div>

                    <div class="lp-feature-card" style="padding:24px;">
                        <h3 style="font-size:15px;font-weight:700;color:var(--lp-primary);margin:0 0 16px;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-sliders-h" style="color:var(--lp-secondary);font-size:13px;"></i>
                            <span>Spesifikasi</span>
                        </h3>
                        <div style="display:flex;flex-direction:column;gap:12px;">
                            <select class="lp-input">
                                <option>Berat (kg)</option>
                                <option>< 1000</option>
                                <option>1000 - 5000</option>
                                <option>5000 - 10000</option>
                                <option>> 10000</option>
                            </select>
                            <select class="lp-input">
                                <option>Daya (HP)</option>
                                <option>< 100</option>
                                <option>100 - 300</option>
                                <option>300 - 500</option>
                                <option>> 500</option>
                            </select>
                        </div>
                    </div>
                </div>
            </aside>

            <div style="flex:1;min-width:0;">
                <div style="display:flex;flex-direction:column;gap:16px;" class="sm:flex-row sm:items-center sm:justify-between sm:gap-4" style="margin-bottom:24px;">
                    <p style="font-size:14px;color:var(--lp-gray-500);margin:0;">Menampilkan <strong style="color:var(--lp-gray-800);">1-12</strong> dari <strong style="color:var(--lp-gray-800);">156</strong> produk</p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <label style="font-size:14px;color:var(--lp-gray-500);">Urutkan:</label>
                        <select class="lp-input" style="padding:8px 12px;font-size:14px;min-width:180px;">
                            <option>Terbaru</option>
                            <option>Harga: Rendah ke Tinggi</option>
                            <option>Harga: Tinggi ke Rendah</option>
                            <option>Nama: A-Z</option>
                            <option>Nama: Z-A</option>
                        </select>
                    </div>
                </div>

                @php
                    $allProducts = [
                        ['name' => 'Excavator EC480D', 'category' => 'Mesin Konstruksi', 'specs' => '48 Ton | 345 HP', 'badge' => 'Best Seller', 'sku' => 'EXC-480D-2026'],
                        ['name' => 'Bulldozer D6R2', 'category' => 'Alat Berat', 'specs' => '30 Ton | 265 HP', 'badge' => 'Promo', 'sku' => 'BLD-D6R2-2026'],
                        ['name' => 'CNC Milling VF-2', 'category' => 'Mesin Manufaktur', 'specs' => 'XYZ: 762x406x508 mm', 'badge' => 'New', 'sku' => 'CNC-VF2-2026'],
                        ['name' => 'Generator C15 500kVA', 'category' => 'Mesin Energi', 'specs' => '500 kVA | Diesel', 'badge' => 'Premium', 'sku' => 'GEN-C15-500'],
                        ['name' => 'Traktor MX285', 'category' => 'Mesin Pertanian', 'specs' => '285 HP | 4WD', 'badge' => 'Popular', 'sku' => 'TRK-MX285'],
                        ['name' => 'Forklift FD50', 'category' => 'Alat Berat', 'specs' => '5 Ton | Diesel', 'badge' => '', 'sku' => 'FKL-FD50'],
                        ['name' => 'Motor Grader 140M', 'category' => 'Mesin Konstruksi', 'specs' => '20 Ton | 210 HP', 'badge' => '', 'sku' => 'GRD-140M'],
                        ['name' => 'Compactor CS76', 'category' => 'Mesin Konstruksi', 'specs' => '16 Ton | 180 HP', 'badge' => 'Sale', 'sku' => 'CMP-CS76'],
                        ['name' => 'Dump Truck HD785', 'category' => 'Alat Berat', 'specs' => '92 Ton | 1200 HP', 'badge' => '', 'sku' => 'DMP-HD785'],
                        ['name' => 'Wheel Loader WA380', 'category' => 'Mesin Konstruksi', 'specs' => '5 Ton | 180 HP', 'badge' => '', 'sku' => 'WHL-WA380'],
                        ['name' => 'Air Compressor XAS185', 'category' => 'Mesin Pengolahan', 'specs' => '185 cfm | 7 bar', 'badge' => '', 'sku' => 'AIR-XAS185'],
                        ['name' => 'Welding Machine 500A', 'category' => 'Mesin Manufaktur', 'specs' => '500A | Inverter', 'badge' => 'Best Seller', 'sku' => 'WLD-500A'],
                    ];
                @endphp

                <div class="lp-grid-3 lp-stagger">
                    @foreach($allProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <nav style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:48px;">
                    <span style="padding:10px 18px;font-size:14px;font-weight:600;background:var(--lp-primary);color:white;border-radius:var(--lp-radius-md);">1</span>
                    <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">2</a>
                    <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">3</a>
                    <span style="padding:0 8px;color:var(--lp-gray-400);">...</span>
                    <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'">13</a>
                    <a href="#" style="padding:10px 18px;font-size:14px;color:var(--lp-gray-600);background:var(--lp-white);border:1px solid var(--lp-gray-200);border-radius:var(--lp-radius-md);text-decoration:none;transition:all 0.2s;" onmouseover="this.style.background='var(--lp-primary)';this.style.color='white'" onmouseout="this.style.background='var(--lp-white)';this.style.color='var(--lp-gray-600)'"><i class="fas fa-chevron-right"></i></a>
                </nav>
            </div>
        </div>
    </div>
</section>
@endsection
