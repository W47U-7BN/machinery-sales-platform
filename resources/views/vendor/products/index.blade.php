@extends('vendor.layouts.vendor')
@section('title', 'Produk Vendor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Katalog Produk</h4>
        <p class="text-muted mb-0">Kelola produk yang Anda supply</p>
    </div>
    <a href="{{ route('vendor.products.create') }}" class="btn btn-dark rounded-pill"><i class="bi bi-plus-circle me-1"></i>Tambah Produk</a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Produk</th>
                        <th class="small">SKU</th>
                        <th class="small">Harga Vendor</th>
                        <th class="small">Harga Jual</th>
                        <th class="small">Stok</th>
                        <th class="small">Status</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products ?? [] as $product)
                    <tr>
                        <td class="px-3">
                            <div class="d-flex align-items-center">
                                @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="rounded-2 me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                                <span class="fw-medium small">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="small text-muted">{{ $product->sku }}</td>
                        <td class="small">Rp {{ number_format($product->vendor_price, 0, ',', '.') }}</td>
                        <td class="small">Rp {{ number_format($product->retail_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }} bg-opacity-10 text-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>{!! $product->status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="{{ route('vendor.products.edit', $product->id) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-box fs-2 d-block mb-2"></i>
                            Belum ada produk. Tambahkan produk pertama Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($products ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $products->links() }}</div>
    @endif
</div>
@endsection
