@extends('layouts.admin')

@section('title', 'Edit Quotation')
@section('page-title', 'Edit Quotation')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Penjualan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Quotations</a></li>
<li class="breadcrumb-item active">Edit QUO-2026-0001</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.quotations.show', 1) }}" class="btn btn-admin-outline me-2"><i class="bi bi-eye me-1"></i> View</a>
<a href="{{ route('admin.quotations.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<form>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header"><h6>Informasi Quotation</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Quotation Number</label>
                            <input type="text" class="form-control" value="QUO-2026-0001" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                            <select class="form-select select2">
                                <option selected>PT Maju Jaya Abadi</option>
                                <option>PT Sejahtera Bersama</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sales Person</label>
                            <select class="form-select"><option>Admin User</option><option>Sales Team A</option><option selected>Sales Team B</option></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" value="2026-06-01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Valid Until</label>
                            <input type="date" class="form-control" value="2026-07-01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select"><option>Draft</option><option selected>Sent</option><option>Approved</option><option>Rejected</option></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <h6>Line Items</h6>
                    <button class="btn btn-sm btn-admin-primary" type="button" onclick="addLineItem()"><i class="bi bi-plus"></i> Add Item</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table data-table mb-0" id="itemsTable">
                            <thead><tr><th>Product</th><th>Description</th><th>Qty</th><th>Unit Price</th><th>Discount %</th><th>Subtotal</th><th></th></tr></thead>
                            <tbody>
                                <tr><td><select class="form-select form-select-sm"><option>Excavator EC220D</option><option>Bulldozer D6R</option></select></td><td><input type="text" class="form-control form-control-sm" value="Excavator EC220D - Standard"></td><td><input type="number" class="form-control form-control-sm qty" value="1" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm price" value="500000000" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm discount" value="0" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm subtotal" value="500000000" readonly></td><td><button class="btn btn-sm btn-outline-danger" onclick="removeItem(this)"><i class="bi bi-x"></i></button></td></tr>
                                <tr><td><select class="form-select form-select-sm"><option>Excavator EC220D</option><option selected>Bulldozer D6R</option></select></td><td><input type="text" class="form-control form-control-sm" value="Bulldozer D6R - Unit"></td><td><input type="number" class="form-control form-control-sm qty" value="1" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm price" value="750000000" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm discount" value="5" onchange="calcSummary()"></td><td><input type="text" class="form-control form-control-sm subtotal" value="712500000" readonly></td><td><button class="btn btn-sm btn-outline-danger" onclick="removeItem(this)"><i class="bi bi-x"></i></button></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header"><h6>Terms & Conditions</h6></div>
                <div class="card-body">
                    <textarea class="form-control" rows="4">1. Payment: 30% DP, 70% before delivery
2. Delivery: 4-6 weeks after order confirmation
3. Warranty: 12 months</textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header"><h6>Summary</h6></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-medium">Rp 1.250.000.000</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Discount</span><span class="fw-medium">-Rp 37.500.000</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Tax (11%)</span><span class="fw-medium">Rp 133.375.000</span></div>
                    <hr>
                    <div class="d-flex justify-content-between"><span class="fw-bold">Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 1.345.875.000</span></div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-admin-primary btn-lg"><i class="bi bi-save me-2"></i> Update Quotation</button>
                <a href="{{ route('admin.quotations.index') }}" class="btn btn-admin-light">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() { $('.select2').select2({ placeholder: 'Pilih Customer' }); });
function calcSummary() { }
function addLineItem() {
    const tbody = $('#itemsTable tbody');
    const row = tbody.find('tr:first').clone();
    row.find('input').val('');
    row.find('.subtotal').val('0');
    tbody.append(row);
}
function removeItem(btn) { if ($('#itemsTable tbody tr').length > 1) $(btn).closest('tr').remove(); }
</script>
@endpush
