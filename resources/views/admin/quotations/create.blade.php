@extends('layouts.admin')

@section('title', 'Create Quotation')
@section('page-title', 'Buat Quotation Baru')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Penjualan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Quotations</a></li>
<li class="breadcrumb-item active">Buat Baru</li>
@endsection

@section('page-actions')
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
                        <div class="col-md-6">
                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                            <select class="form-select select2">
                                <option>Pilih Customer</option>
                                <option>PT Maju Jaya Abadi</option>
                                <option>PT Sejahtera Bersama</option>
                                <option>CV Karya Mandiri</option>
                                <option>PT Global Indotech</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sales Person</label>
                            <select class="form-select">
                                <option>Admin User</option>
                                <option>Sales Team A</option>
                                <option>Sales Team B</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Valid Until <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option>Draft</option>
                                <option>Sent</option>
                            </select>
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
                            <thead><tr><th>Product</th><th>Description</th><th>Qty</th><th>Unit Price</th><th>Discount</th><th>Subtotal</th><th style="width:40px;"></th></tr></thead>
                            <tbody>
                                <tr class="line-item">
                                    <td style="min-width:200px;"><select class="form-select form-select-sm product-select"><option>Select product</option><option>Excavator EC220D</option><option>Bulldozer D6R</option><option>Crane RT100</option></select></td>
                                    <td><input type="text" class="form-control form-control-sm" placeholder="Description" value="Excavator EC220D - Standard"></td>
                                    <td style="width:80px;"><input type="number" class="form-control form-control-sm qty" value="1" min="1" onchange="calcLine(this)"></td>
                                    <td style="width:150px;"><input type="text" class="form-control form-control-sm price" value="500000000" onchange="calcLine(this)"></td>
                                    <td style="width:100px;"><input type="text" class="form-control form-control-sm discount" value="0" onchange="calcLine(this)"></td>
                                    <td style="width:150px;"><input type="text" class="form-control form-control-sm subtotal" value="500000000" readonly></td>
                                    <td><button class="btn btn-sm btn-outline-danger" type="button" onclick="removeItem(this)"><i class="bi bi-x"></i></button></td>
                                </tr>
                                <tr class="line-item">
                                    <td><select class="form-select form-select-sm product-select"><option>Select product</option><option>Excavator EC220D</option><option>Bulldozer D6R</option><option>Crane RT100</option></select></td>
                                    <td><input type="text" class="form-control form-control-sm" placeholder="Description" value="Spare parts kit"></td>
                                    <td><input type="number" class="form-control form-control-sm qty" value="2" min="1" onchange="calcLine(this)"></td>
                                    <td><input type="text" class="form-control form-control-sm price" value="25000000" onchange="calcLine(this)"></td>
                                    <td><input type="text" class="form-control form-control-sm discount" value="10" onchange="calcLine(this)"></td>
                                    <td><input type="text" class="form-control form-control-sm subtotal" value="45000000" readonly></td>
                                    <td><button class="btn btn-sm btn-outline-danger" type="button" onclick="removeItem(this)"><i class="bi bi-x"></i></button></td>
                                </tr>
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
3. Warranty: 12 months from delivery date
4. Installation & training included</textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header"><h6>Summary</h6></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Subtotal</span><span class="fw-medium" id="summary-subtotal">Rp 590.000.000</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Discount</span><span class="fw-medium" id="summary-discount">-Rp 50.000.000</span></div>
                    <div class="d-flex justify-content-between mb-2"><span class="text-muted">Tax (11%)</span><span class="fw-medium" id="summary-tax">Rp 59.400.000</span></div>
                    <hr>
                    <div class="d-flex justify-content-between"><span class="fw-bold">Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);" id="summary-total">Rp 599.400.000</span></div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header"><h6>Additional Info</h6></div>
                <div class="card-body">
                    <div class="mb-3"><label class="form-label">Reference Number</label><input type="text" class="form-control" placeholder="PO number or reference"></div>
                    <div class="mb-3"><label class="form-label">Delivery Address</label><textarea class="form-control" rows="2">Jl. Industri Raya No. 123, Jakarta Utara</textarea></div>
                    <div><label class="form-label">Notes</label><textarea class="form-control" rows="2">Internal notes</textarea></div>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-admin-primary btn-lg"><i class="bi bi-save me-2"></i> Simpan Quotation</button>
                <button type="button" class="btn btn-admin-accent btn-lg"><i class="bi bi-send me-2"></i> Save & Send</button>
                <a href="{{ route('admin.quotations.index') }}" class="btn btn-admin-light">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({ placeholder: 'Pilih Customer', allowClear: true });
});

function calcLine(el) {
    const row = $(el).closest('tr');
    const qty = parseFloat(row.find('.qty').val()) || 0;
    const price = parseFloat(row.find('.price').val()) || 0;
    const discount = parseFloat(row.find('.discount').val()) || 0;
    const subtotal = qty * price * (1 - discount / 100);
    row.find('.subtotal').val(subtotal.toLocaleString('id-ID'));
    calcSummary();
}

function calcSummary() {
    let subtotal = 0, discount = 0;
    $('.line-item').each(function() {
        const qty = parseFloat($(this).find('.qty').val()) || 0;
        const price = parseFloat($(this).find('.price').val()) || 0;
        const disc = parseFloat($(this).find('.discount').val()) || 0;
        const lineSub = qty * price * (1 - disc / 100);
        subtotal += qty * price;
        discount += qty * price * disc / 100;
    });
    const tax = (subtotal - discount) * 0.11;
    const total = subtotal - discount + tax;
    $('#summary-subtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
    $('#summary-discount').text('-Rp ' + discount.toLocaleString('id-ID'));
    $('#summary-tax').text('Rp ' + tax.toLocaleString('id-ID'));
    $('#summary-total').text('Rp ' + total.toLocaleString('id-ID'));
}

function addLineItem() {
    const tbody = $('#itemsTable tbody');
    const row = tbody.find('tr:first').clone();
    row.find('input').val('');
    row.find('.subtotal').val('0');
    tbody.append(row);
}

function removeItem(btn) {
    if ($('#itemsTable tbody tr').length > 1) {
        $(btn).closest('tr').remove();
        calcSummary();
    }
}
</script>
@endpush
