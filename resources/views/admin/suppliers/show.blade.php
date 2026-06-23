@extends('layouts.admin')

@section('title', 'Supplier Detail')
@section('page-title', 'Supplier Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Pembelian</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Suppliers</a></li>
<li class="breadcrumb-item active">SUP-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('admin.suppliers.edit', 1) }}" class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
    <a href="{{ route('admin.purchase-orders.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus me-1"></i> New PO</a>
    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Supplier Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="text-muted small">Company Name</label><p class="fw-semibold">PT Supplier Utama</p></div>
                    <div class="col-md-4"><label class="text-muted small">Code</label><p class="fw-semibold">SUP-0001</p></div>
                    <div class="col-md-4"><label class="text-muted small">NPWP</label><p class="fw-semibold">01.234.567.8-999.000</p></div>
                    <div class="col-md-4"><label class="text-muted small">Contact Person</label><p class="fw-semibold">Budi Hartono</p></div>
                    <div class="col-md-4"><label class="text-muted small">Phone</label><p class="fw-semibold">021-1234-5678</p></div>
                    <div class="col-md-4"><label class="text-muted small">Email</label><p class="fw-semibold">budi@supplier.com</p></div>
                    <div class="col-12"><label class="text-muted small">Address</label><p class="fw-semibold">Jl. Industri Raya No. 456, Jakarta Utara 14240</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Purchase Orders</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>PO #</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,5) as $i)
                        <tr>
                            <td class="fw-medium"><a href="{{ route('admin.purchase-orders.show', $i) }}" class="text-decoration-none">PO-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i*10.' days')) }}</td>
                            <td>{{ rand(1,10) }}</td>
                            <td>Rp {{ number_format(rand(10000000,200000000),0,',','.') }}</td>
                            <td><span class="badge-status bg-{{ ['pending','processing','completed','cancelled','sent'][$i % 5] }}">{{ ['Pending','Processing','Completed','Cancelled','Sent'][$i % 5] }}</span></td>
                            <td><a href="{{ route('admin.purchase-orders.show', $i) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total PO</span><span class="fw-bold">Rp 2.5M</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Outstanding</span><span class="fw-bold text-danger">Rp 850K</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Completed</span><span class="fw-bold text-success">Rp 1.65M</span></div>
                <hr>
                <div class="d-flex justify-content-between"><span class="text-muted">Payment Terms</span><span class="fw-medium">Net 30</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
