@props(['product' => null])
<div {{ $attributes->merge(['class' => 'lp-card']) }}>
    <div class="lp-card-image">
        <img src="{{ $product['image'] ?? asset('images/placeholder.jpg') }}" alt="{{ $product['name'] ?? 'Produk' }}" loading="lazy">
        @if(isset($product['badge']))
            <span class="lp-card-badge lp-card-badge-secondary">{{ $product['badge'] }}</span>
        @endif
        <div class="lp-card-overlay">
            <div style="display:flex;gap:8px;width:100%;">
                <a href="{{ route('products.show', $product['slug'] ?? '#') }}" class="lp-btn lp-btn-sm" style="flex:1;background:rgba(255,255,255,0.9);color:var(--lp-gray-800);border:none;backdrop-filter:blur(8px);">Detail</a>
                <a href="https://wa.me/6281234567890?text={{ urlencode('Saya tertarik dengan ' . ($product['name'] ?? '')) }}" class="lp-btn lp-btn-sm" style="background:rgba(37,211,102,0.9);border:none;color:white;" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="lp-card-body">
        @if(isset($product['category']))
            <div class="lp-card-category">{{ $product['category'] }}</div>
        @endif
        <h3 class="lp-card-title">{{ $product['name'] ?? 'Nama Produk' }}</h3>
        @if(isset($product['specs']))
            <p class="lp-card-text" style="margin-bottom:8px;">{{ $product['specs'] }}</p>
        @endif
        @if(isset($product['sku']))
            <p class="lp-card-text" style="font-size:12px;color:var(--lp-gray-400);">SKU: {{ $product['sku'] }}</p>
        @endif
        @if(isset($product['price']))
            <p style="font-size:20px;font-weight:800;color:var(--lp-primary);margin:8px 0 12px;">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
        @endif
        <div class="lp-card-footer" style="padding:12px 0 0;border-top:1px solid var(--lp-gray-100);margin-top:12px;">
            <a href="{{ route('products.show', $product['slug'] ?? '#') }}" class="lp-btn lp-btn-sm" style="flex:1;background:var(--lp-primary);color:white;border:none;">Detail</a>
            <a href="{{ route('penawaran') }}?product={{ $product['slug'] ?? '' }}" class="lp-btn lp-btn-sm" style="flex:1;background:var(--lp-secondary);color:white;border:none;">Minta Harga</a>
        </div>
    </div>
</div>
