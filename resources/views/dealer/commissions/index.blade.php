@extends('dealer.layouts.dealer')
@section('title', 'Riwayat Komisi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Riwayat Komisi</h4>
        <p class="text-muted mb-0">Pendapatan komisi dari penjualan</p>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Total Komisi</p>
                <h4 class="fw-bold mb-0">Rp {{ number_format($totalCommission ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Komisi Belum Dibayar</p>
                <h4 class="fw-bold mb-0">Rp {{ number_format($pendingCommission ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-info text-white">
            <div class="card-body">
                <p class="small mb-1 opacity-75">Komisi Dibayar</p>
                <h4 class="fw-bold mb-0">Rp {{ number_format($paidCommission ?? 0, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <label class="form-label small">Periode</label>
                <select name="period" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="this_month" {{ request('period') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                    <option value="last_month" {{ request('period') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                    <option value="this_year" {{ request('period') == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Dibayar</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Tanggal</th>
                        <th class="small">Order #</th>
                        <th class="small">Amount</th>
                        <th class="small">Status</th>
                        <th class="small">Tanggal Dibayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions ?? [] as $commission)
                    <tr>
                        <td class="px-3 small text-muted">{{ $commission->created_at->format('d/m/Y') }}</td>
                        <td><span class="fw-medium small">#{{ $commission->order->order_number ?? '-' }}</span></td>
                        <td class="fw-medium text-success">Rp {{ number_format($commission->amount, 0, ',', '.') }}</td>
                        <td>{!! $commission->status_badge !!}</td>
                        <td class="small text-muted">{{ $commission->paid_at ? $commission->paid_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-currency-dollar fs-2 d-block mb-2"></i>
                            Belum ada komisi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($commissions ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $commissions->links() }}</div>
    @endif
</div>
@endsection
