@extends('dealer.layouts.dealer')
@section('title', 'Dashboard Dealer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Dealer' }}!</h4>
        <p class="text-muted mb-0">Ringkasan performa penjualan Anda</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Komisi Bulan Ini</p>
                        <h4 class="fw-bold mb-0 text-success">Rp {{ number_format($commissionThisMonth ?? 0, 0, ',', '.') }}</h4>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-currency-dollar text-success fs-4"></i>
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
                        <p class="text-muted small mb-1">Target Progress</p>
                        <h4 class="fw-bold mb-0">{{ $targetProgress ?? 0 }}%</h4>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-bullseye text-warning fs-4"></i>
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
                        <p class="text-muted small mb-1">Pesanan Bulan Ini</p>
                        <h4 class="fw-bold mb-0">{{ $ordersThisMonth ?? 0 }}</h4>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-cart-check text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-bullseye me-2 text-warning"></i>Progress Target Penjualan</h6>
            </div>
            <div class="card-body px-3">
                <div class="d-flex justify-content-between mb-1">
                    <span class="small">Target: Rp {{ number_format($targetAmount ?? 0, 0, ',', '.') }}</span>
                    <span class="small">Tercapai: Rp {{ number_format($achievedAmount ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="progress" style="height: 24px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $targetProgress ?? 0 }}%;" aria-valuenow="{{ $targetProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $targetProgress ?? 0 }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-transparent border-0 pt-3 px-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Pesanan Terbaru</h6>
        <a href="{{ route('dealer.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Order #</th>
                        <th class="small">Pelanggan</th>
                        <th class="small">Tanggal</th>
                        <th class="small">Total</th>
                        <th class="small">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders ?? [] as $order)
                    <tr>
                        <td class="px-3"><a href="{{ route('dealer.orders.show', $order->id) }}" class="text-decoration-none fw-medium">#{{ $order->order_number }}</a></td>
                        <td class="small">{{ $order->customer_name }}</td>
                        <td class="small text-muted">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="fw-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>{!! $order->status_badge !!}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted small">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
