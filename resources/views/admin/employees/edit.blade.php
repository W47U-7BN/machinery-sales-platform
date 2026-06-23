@extends('layouts.admin')

@section('title', 'Edit Employee')
@section('page-title', 'Edit Karyawan')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">SDM</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a></li>
<li class="breadcrumb-item active">Edit Karyawan 1</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.employees.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>Informasi Karyawan</h6></div>
    <div class="card-body">
        <form>
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">NIK</label><input type="text" class="form-control" value="NIK-00001" readonly></div>
                <div class="col-md-4"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control" value="Budi Santoso"></div>
                <div class="col-md-4"><label class="form-label">Email</label><input type="email" class="form-control" value="budi@company.com"></div>
                <div class="col-md-4"><label class="form-label">No. Telepon</label><input type="text" class="form-control" value="0812-3456-7890"></div>
                <div class="col-md-4"><label class="form-label">Department</label><select class="form-select"><option selected>Sales</option><option>Marketing</option><option>Engineering</option></select></div>
                <div class="col-md-4"><label class="form-label">Position</label><input type="text" class="form-control" value="Sales Manager"></div>
                <div class="col-md-3"><label class="form-label">Join Date</label><input type="date" class="form-control" value="2024-01-15"></div>
                <div class="col-md-3"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
                <div class="col-md-3"><label class="form-label">Salary</label><div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="15000000"></div></div>
                <div class="col-md-3"><label class="form-label">BPJS</label><input type="text" class="form-control" value="BPJS-123456789"></div>
                <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2">Jl. Merdeka No. 45, Jakarta Pusat</textarea></div>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-admin-light">Cancel</a>
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i> Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
