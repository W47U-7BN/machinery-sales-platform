@extends('dealer.layouts.dealer')
@section('title', 'Detail Pesanan #'.$order->order_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pesanan #{{ $order->order_number }}</h4>
        <p class="text-muted mb-0">{{ $order->created_at->format('d F Y H:i') }}</p>
    </div>
    <a href="{{ route('dealer.orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-box me-2 text-primary"></i>Item Pesanan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small px-3">Produk</th>
                                <th class="small">Harga Dealer</th>
                                <th class="small">Qty</th>
                                <th class="small text-end px-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items ?? [] as $item)
                            <tr>
                                <td class="px-3"><span class="fw-medium small">{{ $item->product_name }}</span></td>
                                <td class="small">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end px-3 fw-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted small">Tidak ada item</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold px-3">Total</td>
                                <td class="text-end px-3 fw-bold fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end small px-3">Komisi Anda</td>
                                <td class="text-end px-3 fw-bold text-success">Rp {{ number_format($order->commission ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Pesanan</h6>
            </div>
            <div class="card-body px-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted small">Status</td>
                        <td class="text-end">{!! $order->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Pelanggan</td>
                        <td class="text-end small">{{ $order->customer_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Komisi</td>
                        <td class="text-end text-success fw-medium">Rp {{ number_format($order->commission ?? 0, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
