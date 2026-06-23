@extends('layouts.admin')

@section('title', 'Invoice Detail')
@section('page-title', 'Invoice Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Penjualan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Invoices</a></li>
<li class="breadcrumb-item active">INV-2026-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-accent"><i class="bi bi-printer me-1"></i> Print</button>
    <button class="btn btn-admin-primary"><i class="bi bi-envelope me-1"></i> Send Email</button>
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#paymentModal"><i class="bi bi-cash me-1"></i> Record Payment</button>
    <a href="{{ route('admin.invoices.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Invoice Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3"><label class="text-muted small">Invoice #</label><p class="fw-semibold">INV-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Order Reference</label><p class="fw-semibold">ORD-2026-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Invoice Date</label><p class="fw-semibold">15 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Due Date</label><p class="fw-semibold">15 Jul 2026</p></div>
                    <div class="col-md-6"><label class="text-muted small">Customer</label><p class="fw-semibold">PT Maju Jaya Abadi</p></div>
                    <div class="col-md-6"><label class="text-muted small">Status</label><p><span class="badge-status bg-pending">Unpaid</span></p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Invoice Items</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#</th><th>Product</th><th>Description</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
                    <tbody>
                        <tr><td>1</td><td>Excavator EC220D</td><td>Excavator EC220D - Standard</td><td>1</td><td>Rp 500.000.000</td><td class="fw-semibold">Rp 500.000.000</td></tr>
                        <tr><td>2</td><td>Bulldozer D6R</td><td>Bulldozer D6R - Unit</td><td>1</td><td>Rp 750.000.000</td><td class="fw-semibold">Rp 712.500.000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Payment History</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Date</th><th>Method</th><th>Reference</th><th>Amount</th><th>Status</th></tr></thead>
                    <tbody>
                        <tr><td>20 Jun 2026</td><td>Bank Transfer</td><td>TRF-2026-001</td><td class="fw-semibold">Rp 403.762.500</td><td><span class="badge bg-success rounded-pill px-2">Verified</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-medium">Rp 1.250.000.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Discount</span><span class="fw-medium text-danger">-Rp 37.500.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">PPN (11%)</span><span class="fw-medium">Rp 133.375.000</span></div>
                <hr>
                <div class="d-flex justify-content-between mb-2"><span class="fw-bold fs-5">Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 1.345.875.000</span></div>
                <hr>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total Paid</span><span class="fw-bold text-success">Rp 403.762.500</span></div>
                <div class="d-flex justify-content-between"><span class="text-muted">Balance Due</span><span class="fw-bold text-danger">Rp 942.112.500</span></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Payment Terms</h6></div>
            <div class="card-body">
                <p class="mb-1"><strong>Term:</strong> 30% DP, 70% Before Delivery</p>
                <p class="mb-0"><strong>Bank Account:</strong></p>
                <p class="small text-muted mb-0">BCA - 1234567890<br>PT Perusahaan Mesin Industri</p>
            </div>
        </div>
    </div>
</div>

@include('admin.components.modal', ['id' => 'paymentModal', 'title' => 'Record Payment', 'size' => 'md'])
<form>
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Amount <span class="text-danger">*</span></label><input type="text" class="form-control" value="942.112.500"></div>
        <div class="col-6"><label class="form-label">Payment Date</label><input type="date" class="form-control" value="{{ date('Y-m-d') }}"></div>
        <div class="col-6"><label class="form-label">Payment Method</label><select class="form-select"><option>Bank Transfer</option><option>Cash</option><option>Check</option><option>Credit Card</option></select></div>
        <div class="col-12"><label class="form-label">Reference No</label><input type="text" class="form-control" placeholder="TRF number"></div>
        <div class="col-12"><label class="form-label">Notes</label><textarea class="form-control" rows="2"></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-admin-primary">Record Payment</button>
    </div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
