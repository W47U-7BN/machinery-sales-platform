@extends('vendor.layouts.vendor')
@section('title', 'PO #'.$purchaseOrder->po_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Purchase Order #{{ $purchaseOrder->po_number }}</h4>
        <p class="text-muted mb-0">{{ $purchaseOrder->created_at->format('d F Y') }}</p>
    </div>
    <a href="{{ route('vendor.purchase-orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-box me-2 text-dark"></i>Item Pesanan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small px-3">Produk</th>
                                <th class="small">SKU</th>
                                <th class="small">Qty</th>
                                <th class="small">Harga</th>
                                <th class="small text-end px-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchaseOrder->items ?? [] as $item)
                            <tr>
                                <td class="px-3"><span class="fw-medium small">{{ $item->product_name }}</span></td>
                                <td class="small text-muted">{{ $item->sku ?? '-' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="small">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end px-3 fw-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted small">Tidak ada item</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold px-3">Total</td>
                                <td class="text-end px-3 fw-bold fs-5">Rp {{ number_format($purchaseOrder->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-dark"></i>Informasi PO</h6>
            </div>
            <div class="card-body px-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted small">Status</td>
                        <td class="text-end">{!! $purchaseOrder->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Tanggal PO</td>
                        <td class="text-end small">{{ $purchaseOrder->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @if($purchaseOrder->expected_delivery)
                    <tr>
                        <td class="text-muted small">Estimasi Kirim</td>
                        <td class="text-end small">{{ $purchaseOrder->expected_delivery->format('d/m/Y') }}</td>
                    </tr>
                    @endif
                    @if($purchaseOrder->notes)
                    <tr>
                        <td colspan="2" class="pt-2">
                            <p class="small text-muted mb-0"><strong>Catatan:</strong><br>{{ $purchaseOrder->notes }}</p>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="d-grid gap-2">
            <form method="POST" action="{{ route('vendor.purchase-orders.accept', $purchaseOrder->id) }}">
                @csrf
                <button type="submit" class="btn btn-success w-100 rounded-pill" {{ $purchaseOrder->status != 'pending' ? 'disabled' : '' }}>
                    <i class="bi bi-check-lg me-1"></i>Terima PO
                </button>
            </form>
            <form method="POST" action="{{ route('vendor.purchase-orders.reject', $purchaseOrder->id) }}" onsubmit="return confirm('Yakin menolak PO ini?')">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill" {{ $purchaseOrder->status != 'pending' ? 'disabled' : '' }}>
                    <i class="bi bi-x-lg me-1"></i>Tolak PO
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
