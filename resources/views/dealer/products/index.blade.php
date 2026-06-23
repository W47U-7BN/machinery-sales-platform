@extends('dealer.layouts.dealer')
@section('title', 'Katalog Produk Dealer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Katalog Produk</h4>
        <p class="text-muted mb-0">Harga khusus dealer dengan margin keuntungan</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('dealer.products.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3">
    @forelse($products ?? [] as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="position-relative">
                <img src="{{ $product->image_url ?? 'https://placehold.co/300x200/e2e8f0/64748b?text=Produk' }}" class="card-img-top rounded-top-4" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                @if($product->stock <= 0)<span class="position-absolute top-0 end-0 badge bg-danger m-2">Stok Habis</span>@endif
            </div>
            <div class="card-body d-flex flex-column">
                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                <p class="text-muted small mb-2">{{ Str::limit($product->description, 60) }}</p>
                <div class="mb-2">
                    <span class="text-muted small text-decoration-line-through">Retail: Rp {{ number_format($product->retail_price, 0, ',', '.') }}</span>
                </div>
                <div class="mb-2">
                    <span class="text-success fw-bold fs-5">Rp {{ number_format($product->dealer_price, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-light text-success">Margin: {{ $product->margin_percentage ?? 0 }}%</span>
                    <span class="small text-muted"><i class="bi bi-box me-1"></i>{{ $product->stock }}</span>
                </div>
                <form method="POST" action="{{ route('dealer.cart.add', $product->id) }}" class="mt-auto">
                    @csrf
                    <div class="input-group input-group-sm mb-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="this.nextElementSibling.stepDown()">-</button>
                        <input type="number" name="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="this.previousElementSibling.stepUp()">+</button>
                    </div>
                    <button type="submit" class="btn btn-success w-100 btn-sm rounded-pill" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-box fs-1 d-block mb-2"></i>
                Tidak ada produk
            </div>
        </div>
    </div>
    @endforelse
</div>

@if(method_exists($products ?? [], 'links'))
<div class="mt-3">{{ $products->links() }}</div>
@endif
@endsection
