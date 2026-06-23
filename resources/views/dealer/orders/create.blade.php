@extends('dealer.layouts.dealer')
@section('title', 'Buat Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Buat Pesanan Baru</h4>
        <p class="text-muted mb-0">Pilih produk untuk dibuat pesanan</p>
    </div>
    <a href="{{ route('dealer.orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-cart me-2 text-success"></i>Keranjang Belanja</h6>
            </div>
            <div class="card-body p-0">
                <form method="POST" action="{{ route('dealer.orders.store') }}">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="small px-3">Produk</th>
                                    <th class="small">Harga Dealer</th>
                                    <th class="small" style="width: 120px;">Qty</th>
                                    <th class="small text-end px-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="cartItems">
                                @forelse($cartItems ?? [] as $item)
                                <tr>
                                    <td class="px-3">
                                        <span class="fw-medium small">{{ $item->product->name }}</span>
                                        <input type="hidden" name="items[{{ $loop->index }}][product_id]" value="{{ $item->product_id }}">
                                    </td>
                                    <td class="small">Rp {{ number_format($item->product->dealer_price, 0, ',', '.') }}</td>
                                    <td>
                                        <input type="number" name="items[{{ $loop->index }}][quantity]" class="form-control form-control-sm text-center" value="{{ $item->quantity }}" min="1">
                                    </td>
                                    <td class="text-end px-3 fw-medium">Rp {{ number_format($item->product->dealer_price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-cart-x fs-2 d-block mb-2"></i>
                                        Keranjang kosong. Silakan pilih produk terlebih dahulu.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(count($cartItems ?? []) > 0)
                    <div class="card-footer bg-transparent border-0 px-3 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold">Total:</span>
                                <span class="fw-bold fs-5 text-success ms-2">Rp {{ number_format($cartTotal ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <button type="submit" class="btn btn-success rounded-pill px-5"><i class="bi bi-check-lg me-1"></i>Konfirmasi Pesanan</button>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-success"></i>Informasi</h6>
            </div>
            <div class="card-body px-3">
                <p class="small text-muted mb-0">
                    <i class="bi bi-check-circle text-success me-1"></i>Harga yang ditampilkan adalah harga khusus dealer.
                </p>
                <p class="small text-muted mb-0 mt-2">
                    <i class="bi bi-check-circle text-success me-1"></i>Pesanan akan diproses setelah konfirmasi admin.
                </p>
                <p class="small text-muted mb-0 mt-2">
                    <i class="bi bi-check-circle text-success me-1"></i>Minimal pemesanan: 1 unit per produk.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
