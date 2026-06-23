@extends('vendor.layouts.vendor')
@section('title', 'Dashboard Vendor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Vendor' }}!</h4>
        <p class="text-muted mb-0">Ringkasan aktivitas vendor</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Total Produk</p>
                        <h4 class="fw-bold mb-0">{{ $totalProducts ?? 0 }}</h4>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">PO Aktif</p>
                        <h4 class="fw-bold mb-0">{{ $activePurchaseOrders ?? 0 }}</h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-file-earmark-text text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Total Pembayaran</p>
                        <h4 class="fw-bold mb-0 text-success">Rp {{ number_format($totalPayments ?? 0, 0, ',', '.') }}</h4>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-credit-card text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-file-earmark-text me-2 text-warning"></i>Purchase Order Terbaru</h6>
                <a href="{{ route('vendor.purchase-orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small px-3">PO #</th>
                                <th class="small">Tanggal</th>
                                <th class="small">Status</th>
                                <th class="small text-end px-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPurchaseOrders ?? [] as $po)
                            <tr>
                                <td class="px-3"><a href="{{ route('vendor.purchase-orders.show', $po->id) }}" class="text-decoration-none fw-medium">#{{ $po->po_number }}</a></td>
                                <td class="small text-muted">{{ $po->created_at->format('d/m/Y') }}</td>
                                <td>{!! $po->status_badge !!}</td>
                                <td class="text-end px-3 fw-medium">Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada PO</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-success"></i>Riwayat Pembayaran</h6>
                <a href="{{ route('vendor.payments.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small px-3">Tanggal</th>
                                <th class="small">Deskripsi</th>
                                <th class="small text-end px-3">Jumlah</th>
                                <th class="small">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments ?? [] as $payment)
                            <tr>
                                <td class="px-3 small text-muted">{{ $payment->created_at->format('d/m/Y') }}</td>
                                <td class="small">{{ Str::limit($payment->description, 30) }}</td>
                                <td class="text-end px-3 fw-medium text-success">+Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td>{!! $payment->status_badge !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada pembayaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
