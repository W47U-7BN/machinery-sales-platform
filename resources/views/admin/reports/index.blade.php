@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Laporan & Reports')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(26,58,92,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:var(--admin-primary);"><i class="bi bi-graph-up-arrow"></i></div>
                <h6 class="fw-bold">Penjualan</h6>
                <p class="small text-muted">Laporan penjualan per periode, produk, dan sales</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(46,204,113,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#2ecc71;"><i class="bi bi-cash-coin"></i></div>
                <h6 class="fw-bold">Keuangan</h6>
                <p class="small text-muted">Laporan keuangan, arus kas, laba rugi</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(52,152,219,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#3498db;"><i class="bi bi-box"></i></div>
                <h6 class="fw-bold">Produk</h6>
                <p class="small text-muted">Laporan stok produk, best seller, slow moving</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(155,89,182,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#9b59b6;"><i class="bi bi-people"></i></div>
                <h6 class="fw-bold">Pelanggan</h6>
                <p class="small text-muted">Laporan data pelanggan, segmentasi, aktivitas</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(230,126,34,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:var(--admin-accent);"><i class="bi bi-funnel"></i></div>
                <h6 class="fw-bold">Leads</h6>
                <p class="small text-muted">Laporan leads, konversi, sumber leads</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="admin-card h-100">
            <div class="card-body text-center">
                <div style="width:56px;height:56px;background:rgba(231,76,60,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#e74c3c;"><i class="bi bi-archive"></i></div>
                <h6 class="fw-bold">Inventori</h6>
                <p class="small text-muted">Laporan stok, nilai inventori, mutasi</p>
                <div class="d-flex gap-2 mt-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Date range">
                    <button class="btn btn-sm btn-admin-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="admin-card mt-4">
    <div class="card-header"><h6>Quick Report</h6></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table data-table mb-0">
                <thead><tr><th>Report</th><th>Last Generated</th><th>Format</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach(['Monthly Sales Report','Quarterly Financial Report','Inventory Valuation','Customer Activity','Leads Conversion','Product Performance'] as $i => $rpt)
                    <tr>
                        <td class="fw-medium">{{ $rpt }}</td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.rand(1,30).' days')) }}</td>
                        <td><span class="badge bg-light text-dark me-1">PDF</span><span class="badge bg-light text-dark">Excel</span></td>
                        <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
