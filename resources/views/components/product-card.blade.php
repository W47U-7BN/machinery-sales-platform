@props(['product' => null])
<div {{ $attributes->merge(['class' => 'group bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1']) }}>
    <div class="relative overflow-hidden aspect-[4/3] bg-gray-100">
        <img src="{{ $product['image'] ?? 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400' }}" alt="{{ $product['name'] ?? 'Produk' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @if(isset($product['badge']) && $product['badge'])
            <span class="absolute top-3 left-3 px-3 py-1 bg-secondary text-white text-xs font-semibold rounded-full">{{ $product['badge'] }}</span>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <div class="absolute bottom-3 left-3 right-3 flex items-center space-x-2">
                <a href="{{ route('products.show', Str::slug($product['name'] ?? 'produk')) }}" class="flex-1 px-3 py-2 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-semibold rounded-lg hover:bg-white transition-all text-center">Detail</a>
                <a href="https://wa.me/6281234567890?text={{ urlencode('Saya tertarik dengan ' . ($product['name'] ?? '')) }}" class="px-3 py-2 bg-green-500/90 backdrop-blur-sm text-white text-xs rounded-lg hover:bg-green-500 transition-all" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="p-5">
        @if(isset($product['category']))
            <span class="text-xs text-secondary font-medium uppercase tracking-wider">{{ $product['category'] }}</span>
        @endif
        <h3 class="mt-1 font-semibold text-gray-800 group-hover:text-primary transition-colors line-clamp-2">{{ $product['name'] ?? 'Nama Produk' }}</h3>
        @if(isset($product['specs']))
            <p class="mt-1 text-xs text-gray-500 line-clamp-1">{{ $product['specs'] }}</p>
        @endif
        @if(isset($product['sku']))
            <p class="mt-1 text-xs text-gray-400">SKU: {{ $product['sku'] }}</p>
        @endif
        <div class="mt-3 flex items-center space-x-2">
            <a href="{{ route('products.show', Str::slug($product['name'] ?? 'produk')) }}" class="flex-1 text-center px-4 py-2 border border-primary text-primary text-xs font-semibold rounded-lg hover:bg-primary hover:text-white transition-all">Detail</a>
            <a href="{{ route('penawaran') }}" class="flex-1 text-center px-4 py-2 bg-primary text-white text-xs font-semibold rounded-lg hover:bg-primary-600 transition-all">Minta Harga</a>
        </div>
    </div>
</div>
