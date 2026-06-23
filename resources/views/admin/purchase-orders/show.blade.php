@extends('layouts.admin')

@section('title', 'Purchase Order Detail')
@section('page-title', 'Purchase Order Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.purchase-orders.index') }}">Pembelian</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.purchase-orders.index') }}">Purchase Orders</a></li>
<li class="breadcrumb-item active">PO-2026-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</button>
    <button class="btn btn-admin-accent"><i class="bi bi-send me-1"></i> Send to Supplier</button>
    <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>PO Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3"><label class="text-muted small">PO Number</label><p class="fw-semibold">PO-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Date</label><p class="fw-semibold">15 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Expected Delivery</label><p class="fw-semibold">15 Jul 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Status</label><p><span class="badge-status bg-sent">Sent</span></p></div>
                    <div class="col-md-6"><label class="text-muted small">Supplier</label><p class="fw-semibold">PT Supplier Utama</p></div>
                    <div class="col-md-6"><label class="text-muted small">Payment Terms</label><p class="fw-semibold">Net 30</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Items</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#</th><th>Product</th><th>Description</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>Excavator EC220D</td><td>Engine spare parts</td><td>5</td><td>Rp 25.000.000</td><td class="fw-semibold">Rp 125.000.000</td></tr>
                        <tr><td>2</td><td>Hydraulic Filter</td><td>Filter kit for EC220D</td><td>10</td><td>Rp 1.500.000</td><td class="fw-semibold">Rp 15.000.000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-medium">Rp 140.000.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Tax (11%)</span><span class="fw-medium">Rp 15.400.000</span></div>
                <hr>
                <div class="d-flex justify-content-between"><span class="fw-bold fs-5">Grand Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 155.400.000</span></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Status Timeline</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">Today</div><div class="timeline-title">PO Sent to Supplier</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">15 Jun 2026</div><div class="timeline-title">PO Created</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
