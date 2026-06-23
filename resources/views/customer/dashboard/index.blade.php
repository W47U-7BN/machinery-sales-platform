@extends('customer.layouts.customer')
@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Customer' }}!</h4>
        <p class="text-muted mb-0">Ringkasan aktivitas akun Anda</p>
    </div>
    <span class="badge bg-primary fs-6 rounded-pill px-3 py-2">
        <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}
    </span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Total Pesanan</p>
                        <h3 class="fw-bold mb-0">{{ $totalOrders ?? 0 }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-box-seam text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Tiket Aktif</p>
                        <h3 class="fw-bold mb-0">{{ $activeTickets ?? 0 }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-wrench text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Penawaran Pending</p>
                        <h3 class="fw-bold mb-0">{{ $pendingQuotations ?? 0 }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-file-text text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted small mb-1">Downloads</p>
                        <h3 class="fw-bold mb-0">{{ $totalDownloads ?? 0 }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-download text-success fs-4"></i>
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
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Pesanan Terbaru</h6>
                <a href="{{ route('customer.orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body px-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small">Order #</th>
                                <th class="small">Tanggal</th>
                                <th class="small">Status</th>
                                <th class="small">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td><a href="{{ route('customer.orders.show', $order->id) }}" class="text-decoration-none fw-medium">#{{ $order->order_number }}</a></td>
                                <td class="small text-muted">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{!! $order->status_badge !!}</td>
                                <td class="fw-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada pesanan</td>
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
                <h6 class="fw-bold mb-0"><i class="bi bi-ticket me-2 text-warning"></i>Tiket Service Terbaru</h6>
                <a href="{{ route('customer.service-tickets.index') }}" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
            </div>
            <div class="card-body px-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small">Tiket</th>
                                <th class="small">Subjek</th>
                                <th class="small">Status</th>
                                <th class="small">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTickets ?? [] as $ticket)
                            <tr>
                                <td><a href="{{ route('customer.service-tickets.show', $ticket->id) }}" class="text-decoration-none fw-medium">#{{ $ticket->ticket_number }}</a></td>
                                <td class="small">{{ Str::limit($ticket->subject, 30) }}</td>
                                <td>{!! $ticket->status_badge !!}</td>
                                <td class="small text-muted">{{ $ticket->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted small">Belum ada tiket service</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-2">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-lightning me-2 text-secondary"></i>Aksi Cepat</h6>
            </div>
            <div class="card-body px-3 py-3">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('customer.service-tickets.create') }}" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-plus-circle me-1"></i>Buat Tiket Service
                    </a>
                    <a href="{{ route('customer.downloads.index') }}" class="btn btn-info text-white rounded-pill px-4">
                        <i class="bi bi-download me-1"></i>Download Katalog
                    </a>
                    <a href="{{ route('penawaran') }}" class="btn btn-secondary rounded-pill px-4">
                        <i class="bi bi-file-earmark-text me-1"></i>Minta Penawaran
                    </a>
                    <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-box-seam me-1"></i>Cek Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
