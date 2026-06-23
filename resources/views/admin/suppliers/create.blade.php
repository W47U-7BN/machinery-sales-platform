@extends('layouts.admin')

@section('title', 'Create Supplier')
@section('page-title', 'Tambah Supplier Baru')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Pembelian</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Suppliers</a></li>
<li class="breadcrumb-item active">Tambah Baru</li>
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
                <div class="col-md-6"><label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
                <div class="col-md-3"><label class="form-label">Kode Supplier</label><input type="text" class="form-control" placeholder="Auto"></div>
                <div class="col-md-3"><label class="form-label">NPWP</label><input type="text" class="form-control" placeholder="XX.XXX.XXX.X-XXX.XXX"></div>
                <div class="col-md-6"><label class="form-label">Contact Person</label><input type="text" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">No. Telepon <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
                <div class="col-md-4"><label class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control" required></div>
                <div class="col-md-4"><label class="form-label">Website</label><input type="url" class="form-control" placeholder="https://"></div>
                <div class="col-md-4"><label class="form-label">City</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Province</label><input type="text" class="form-control"></div>
                <div class="col-md-4"><label class="form-label">Kode Pos</label><input type="text" class="form-control"></div>
                <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2"></textarea></div>
                <div class="col-md-6"><label class="form-label">Payment Terms</label><select class="form-select"><option>Net 30</option><option>Net 15</option><option>Net 45</option><option>COD</option></select></div>
                <div class="col-md-6"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
                <div class="col-12"><label class="form-label">Notes</label><textarea class="form-control" rows="2"></textarea></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-admin-light">Cancel</a>
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i> Simpan Supplier</button>
            </div>
        </form>
    </div>
</div>
@endsection
