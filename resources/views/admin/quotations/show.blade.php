@extends('layouts.admin')

@section('title', 'Quotation Detail')
@section('page-title', 'Quotation Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Penjualan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Quotations</a></li>
<li class="breadcrumb-item active">QUO-2026-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('admin.quotations.edit', 1) }}" class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
    <button class="btn btn-admin-accent"><i class="bi bi-printer me-1"></i> Print</button>
    <button class="btn btn-admin-outline"><i class="bi bi-envelope me-1"></i> Send Email</button>
    <button class="btn btn-success text-white"><i class="bi bi-check-circle me-1"></i> Convert to Order</button>
    <a href="{{ route('admin.quotations.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Quotation Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3"><label class="text-muted small">Number</label><p class="fw-semibold">QUO-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Date</label><p class="fw-semibold">01 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Valid Until</label><p class="fw-semibold">01 Jul 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Status</label><p><span class="badge-status bg-sent">Sent</span></p></div>
                    <div class="col-md-6"><label class="text-muted small">Customer</label><p class="fw-semibold">PT Maju Jaya Abadi</p></div>
                    <div class="col-md-6"><label class="text-muted small">Sales Person</label><p class="fw-semibold">Sales Team B</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Line Items</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#</th><th>Product</th><th>Description</th><th>Qty</th><th>Unit Price</th><th>Discount</th><th>Subtotal</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>Excavator EC220D</td><td>Excavator EC220D - Standard</td><td>1</td><td>Rp 500.000.000</td><td>0%</td><td class="fw-semibold">Rp 500.000.000</td></tr>
                        <tr><td>2</td><td>Bulldozer D6R</td><td>Bulldozer D6R - Unit</td><td>1</td><td>Rp 750.000.000</td><td>5%</td><td class="fw-semibold">Rp 712.500.000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Terms & Conditions</h6></div>
            <div class="card-body">
                <ol class="mb-0 ps-3">
                    <li>Payment: 30% DP, 70% before delivery</li>
                    <li>Delivery: 4-6 weeks after order confirmation</li>
                    <li>Warranty: 12 months from delivery date</li>
                    <li>Installation and training included</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-medium">Rp 1.250.000.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Discount</span><span class="fw-medium text-danger">-Rp 37.500.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Dasar Pengenaan Pajak</span><span class="fw-medium">Rp 1.212.500.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">PPN (11%)</span><span class="fw-medium">Rp 133.375.000</span></div>
                <hr>
                <div class="d-flex justify-content-between"><span class="fw-bold fs-5">Grand Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 1.345.875.000</span></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Activity</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">Today</div><div class="timeline-title">Viewed by customer</div></div>
                    <div class="timeline-item"><div class="timeline-dot success"></div><div class="timeline-time">01 Jun 2026</div><div class="timeline-title">Quotation sent to customer</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">01 Jun 2026</div><div class="timeline-title">Quotation created</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
