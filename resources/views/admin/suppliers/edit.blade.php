@extends('layouts.admin')

@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Pembelian</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Suppliers</a></li>
<li class="breadcrumb-item active">Edit SUP-0001</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.suppliers.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>Informasi Supplier</h6></div>
    <div class="card-body">
        <form>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label><input type="text" class="form-control" value="PT Supplier Utama"></div>
                <div class="col-md-3"><label class="form-label">Kode Supplier</label><input type="text" class="form-control" value="SUP-0001" readonly></div>
                <div class="col-md-3"><label class="form-label">NPWP</label><input type="text" class="form-control" value="01.234.567.8-999.000"></div>
                <div class="col-md-6"><label class="form-label">Contact Person</label><input type="text" class="form-control" value="Budi Hartono"></div>
                <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control" value="Sales Director"></div>
                <div class="col-md-4"><label class="form-label">No. Telepon <span class="text-danger">*</span></label><input type="text" class="form-control" value="021-1234-5678"></div>
                <div class="col-md-4"><label class="form-label">Email</label><input type="email" class="form-control" value="budi@supplier.com"></div>
                <div class="col-md-4"><label class="form-label">Website</label><input type="url" class="form-control" value="https://supplier.com"></div>
                <div class="col-md-4"><label class="form-label">City</label><input type="text" class="form-control" value="Jakarta"></div>
                <div class="col-md-4"><label class="form-label">Province</label><input type="text" class="form-control" value="DKI Jakarta"></div>
                <div class="col-md-4"><label class="form-label">Kode Pos</label><input type="text" class="form-control" value="14240"></div>
                <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2">Jl. Industri Raya No. 456, Jakarta Utara</textarea></div>
                <div class="col-md-6"><label class="form-label">Payment Terms</label><select class="form-select"><option selected>Net 30</option><option>Net 15</option><option>Net 45</option></select></div>
                <div class="col-md-6"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
                <div class="col-12"><label class="form-label">Notes</label><textarea class="form-control" rows="2">Supplier utama untuk komponen hidrolik dan engine.</textarea></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-admin-light">Cancel</a>
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i> Update Supplier</button>
            </div>
        </form>
    </div>
</div>
@endsection
