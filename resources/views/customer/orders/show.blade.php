@extends('customer.layouts.customer')
@section('title', 'Detail Pesanan #'.$order->order_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pesanan #{{ $order->order_number }}</h4>
        <p class="text-muted mb-0">{{ $order->created_at->format('d F Y H:i') }}</p>
    </div>
    <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Progress Pesanan</h6>
            </div>
            <div class="card-body px-3">
                <div class="timeline">
                    @forelse($order->timelines ?? [] as $timeline)
                    <div class="d-flex mb-3">
                        <div class="me-3 text-center">
                            <div class="bg-primary rounded-circle" style="width: 12px; height: 12px;"></div>
                        </div>
                        <div>
                            <p class="mb-0 fw-medium small">{{ $timeline->status_label }}</p>
                            <p class="text-muted small mb-0">{{ $timeline->created_at->format('d/m/Y H:i') }}</p>
                            @if($timeline->notes)<p class="text-muted small mb-0">{{ $timeline->notes }}</p>@endif
                        </div>
                    </div>
                    @empty
                    <p class="text-muted small">Belum ada update progress</p>
                    @endforelse
                </div>
            </div>
        </div>

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
                                <th class="small">Qty</th>
                                <th class="small">Harga</th>
                                <th class="small text-end px-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order->items ?? [] as $item)
                            <tr>
                                <td class="px-3">
                                    <span class="fw-medium small">{{ $item->product_name }}</span>
                                    @if($item->sku)<br><span class="text-muted small">SKU: {{ $item->sku }}</span>@endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end px-3 fw-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Tidak ada item</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end small fw-medium px-3">Subtotal</td>
                                <td class="text-end px-3 small">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @if($order->discount > 0)
                            <tr>
                                <td colspan="3" class="text-end small fw-medium px-3">Diskon</td>
                                <td class="text-end px-3 small text-danger">-Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="text-end small fw-medium px-3">Ongkos Kirim</td>
                                <td class="text-end px-3 small">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-bold px-3">Total</td>
                                <td class="text-end px-3 fw-bold fs-5">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
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
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi Pesanan</h6>
            </div>
            <div class="card-body px-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted small">Status</td>
                        <td class="text-end">{!! $order->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Metode Bayar</td>
                        <td class="text-end small">{{ $order->payment_method ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Status Bayar</td>
                        <td class="text-end">{!! $order->payment_status_badge !!}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($order->shipping_address)
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-truck me-2 text-primary"></i>Informasi Pengiriman</h6>
            </div>
            <div class="card-body px-3">
                <p class="small mb-1"><strong>Alamat:</strong></p>
                <p class="small text-muted mb-0">{{ $order->shipping_address }}</p>
                @if($order->tracking_number)
                <hr class="my-2">
                <p class="small mb-1"><strong>No. Resi:</strong> {{ $order->tracking_number }}</p>
                <p class="small mb-1"><strong>Kurir:</strong> {{ $order->courier ?? '-' }}</p>
                @endif
            </div>
        </div>
        @endif

        <div class="d-grid gap-2">
            <a href="#" class="btn btn-primary rounded-pill"><i class="bi bi-download me-1"></i>Download Invoice</a>
            @if($order->tracking_number)
            <a href="#" class="btn btn-outline-info rounded-pill"><i class="bi bi-truck me-1"></i>Lacak Pengiriman</a>
            @endif
        </div>
    </div>
</div>
@endsection
