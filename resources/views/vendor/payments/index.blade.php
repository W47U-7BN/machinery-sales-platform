@extends('vendor.layouts.vendor')
@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Riwayat Pembayaran</h4>
        <p class="text-muted mb-0">Daftar pembayaran dari perusahaan</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Total Dibayar</p>
                <h4 class="fw-bold mb-0">Rp {{ number_format($totalPaid ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Menunggu Pembayaran</p>
                <h4 class="fw-bold mb-0">Rp {{ number_format($pendingPayment ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-info text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Total PO</p>
                <h4 class="fw-bold mb-0">{{ $totalPO ?? 0 }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Tanggal</th>
                        <th class="small">PO #</th>
                        <th class="small">Deskripsi</th>
                        <th class="small">Jumlah</th>
                        <th class="small">Metode</th>
                        <th class="small">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments ?? [] as $payment)
                    <tr>
                        <td class="px-3 small text-muted">{{ $payment->created_at->format('d/m/Y') }}</td>
                        <td><span class="fw-medium small">#{{ $payment->purchaseOrder->po_number ?? '-' }}</span></td>
                        <td class="small">{{ Str::limit($payment->description, 30) }}</td>
                        <td class="fw-medium text-success">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="small">{{ $payment->method ?? '-' }}</td>
                        <td>{!! $payment->status_badge !!}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-credit-card fs-2 d-block mb-2"></i>
                            Belum ada pembayaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($payments ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $payments->links() }}</div>
    @endif
</div>
@endsection
