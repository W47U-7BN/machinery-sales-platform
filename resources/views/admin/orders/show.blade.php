@extends('layouts.admin')

@section('title', 'Order Detail')
@section('page-title', 'Order Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Penjualan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
<li class="breadcrumb-item active">ORD-2026-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-accent"><i class="bi bi-printer me-1"></i> Print</button>
    <button class="btn btn-admin-primary"><i class="bi bi-truck me-1"></i> Update Status</button>
    <a href="{{ route('admin.invoices.create') }}" class="btn btn-outline-success"><i class="bi bi-file-text me-1"></i> Create Invoice</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Order Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3"><label class="text-muted small">Order Number</label><p class="fw-semibold">ORD-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Order Date</label><p class="fw-semibold">15 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Reference</label><p class="fw-semibold">QUO-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Status</label><p><span class="badge-status bg-processing">Processing</span></p></div>
                    <div class="col-md-6"><label class="text-muted small">Customer</label><p class="fw-semibold">PT Maju Jaya Abadi</p></div>
                    <div class="col-md-6"><label class="text-muted small">Sales Person</label><p class="fw-semibold">Sales Team B</p></div>
                    <div class="col-12"><label class="text-muted small">Delivery Address</label><p class="fw-semibold">Jl. Gatot Subroto Kav. 56, Jakarta Selatan 12950</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Order Items</h6></div>
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
            <div class="card-header"><h6>Order Timeline</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item"><div class="timeline-dot success"></div><div class="timeline-time">Today, 10:30</div><div class="timeline-title">Payment Confirmed</div><div class="timeline-text">DP 30% received via bank transfer - Rp 403.762.500</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">15 Jun 2026, 14:00</div><div class="timeline-title">Order Processing</div><div class="timeline-text">Items being prepared for shipment</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">14 Jun 2026, 09:00</div><div class="timeline-title">Order Confirmed</div><div class="timeline-text">Customer confirmed and approved quotation</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">10 Jun 2026</div><div class="timeline-title">Quotation Sent</div><div class="timeline-text">Quotation QUO-2026-0001 sent to customer</div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Payment Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total Order</span><span class="fw-bold">Rp 1.345.875.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Paid</span><span class="fw-bold text-success">Rp 403.762.500</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Balance Due</span><span class="fw-bold text-danger">Rp 942.112.500</span></div>
                <hr>
                <div class="d-flex justify-content-between"><span class="text-muted">Payment Terms</span><span class="fw-medium">30% DP + 70% Before Delivery</span></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Shipping Info</h6></div>
            <div class="card-body">
                <div class="mb-2"><label class="text-muted small">Delivery Date</label><p class="fw-medium">Estimated: 30 Jul 2026</p></div>
                <div class="mb-2"><label class="text-muted small">Shipping Method</label><p class="fw-medium">Truck - Door to Door</p></div>
                <div><label class="text-muted small">Tracking</label><p class="fw-medium">-</p></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Status Update</h6></div>
            <div class="card-body">
                <select class="form-select mb-3"><option>Pending</option><option selected>Processing</option><option>Sent</option><option>Completed</option><option>Cancelled</option></select>
                <textarea class="form-control mb-3" rows="2" placeholder="Notes...">Items ready for shipment</textarea>
                <button class="btn btn-admin-primary w-100">Update Status</button>
            </div>
        </div>
    </div>
</div>
@endsection
