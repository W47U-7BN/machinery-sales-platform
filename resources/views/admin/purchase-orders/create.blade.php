@extends('layouts.admin')

@section('title', 'Create Purchase Order')
@section('page-title', 'Buat Purchase Order Baru')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.purchase-orders.index') }}">Pembelian</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.purchase-orders.index') }}">Purchase Orders</a></li>
<li class="breadcrumb-item active">Buat Baru</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<form>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header"><h6>Informasi PO</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Supplier <span class="text-danger">*</span></label><select class="form-select select2"><option>Pilih Supplier</option><option>PT Supplier Utama</option><option>PT Supplier Makmur</option></select></div>
                        <div class="col-md-6"><label class="form-label">Status</label><select class="form-select"><option>Draft</option><option>Sent</option></select></div>
                        <div class="col-md-4"><label class="form-label">PO Date</label><input type="date" class="form-control" value="{{ date('Y-m-d') }}"></div>
                        <div class="col-md-4"><label class="form-label">Expected Delivery</label><input type="date" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label">Payment Terms</label><select class="form-select"><option>Net 30</option><option>Net 15</option><option>COD</option></select></div>
                        <div class="col-12"><label class="form-label">Notes</label><textarea class="form-control" rows="2"></textarea></div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header">
                    <h6>Line Items</h6>
                    <button class="btn btn-sm btn-admin-primary" type="button" onclick="addLine()"><i class="bi bi-plus"></i> Add Item</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table data-table mb-0" id="itemsTable">
                            <thead><tr><th>Product</th><th>Description</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th><th></th></tr></thead>
                            <tbody>
                                <tr><td><select class="form-select form-select-sm"><option>Excavator EC220D</option><option>Bulldozer D6R</option></select></td><td><input type="text" class="form-control form-control-sm" value="Engine spare parts"></td><td><input type="number" class="form-control form-control-sm qty" value="5"></td><td><input type="text" class="form-control form-control-sm price" value="25000000"></td><td><input type="text" class="form-control form-control-sm subtotal" value="125000000" readonly></td><td><button class="btn btn-sm btn-outline-danger" onclick="removeItem(this)"><i class="bi bi-x"></i></button></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header"><h6>Summary</h6></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><span class="fw-medium">Rp 125.000.000</span></div>
                    <div class="d-flex justify-content-between mb-2"><span>Tax (11%)</span><span class="fw-medium">Rp 13.750.000</span></div>
                    <hr>
                    <div class="d-flex justify-content-between"><span class="fw-bold">Total</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 138.750.000</span></div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-admin-primary btn-lg"><i class="bi bi-save me-1"></i> Simpan PO</button>
                <a href="{{ route('admin.purchase-orders.index') }}" class="btn btn-admin-light">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function(){$('.select2').select2({placeholder:'Pilih Supplier'});});
function addLine(){var t=$('#itemsTable tbody'),r=t.find('tr:first').clone();r.find('input').val(''),t.append(r);}
function removeItem(e){if($('#itemsTable tbody tr').length>1)$(e).closest('tr').remove();}
</script>
@endpush
