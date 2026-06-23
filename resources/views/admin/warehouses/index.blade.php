@extends('layouts.admin')

@section('title', 'Warehouses')
@section('page-title', 'Warehouses Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.warehouses.index') }}">Inventori</a></li>
<li class="breadcrumb-item active">Warehouses</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addWarehouseModal"><i class="bi bi-plus-lg me-1"></i> Tambah Warehouse</button>
@endsection

@section('content')
<div class="row g-4">
    @foreach(range(1,6) as $i)
    <div class="col-xl-4 col-md-6">
        <div class="admin-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">Warehouse {{ ['Utama','Surabaya','Bandung','Medan','Makassar','Balikpapan'][$i-1] }}</h6>
                        <small class="text-muted">Code: WH-{{ str_pad($i,3,'0',STR_PAD_LEFT) }}</small>
                    </div>
                    <div style="width:44px;height:44px;background:rgba(26,58,92,0.1);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:20px;color:var(--admin-primary);"><i class="bi bi-building"></i></div>
                </div>
                <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1"></i> {{ ['Jakarta Utara','Surabaya','Bandung','Medan','Makassar','Balikpapan'][$i-1] }}</p>
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-muted">Total Items:</span>
                    <span class="fw-semibold">{{ rand(50,500) }}</span>
                </div>
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-muted">Capacity Used:</span>
                    <span class="fw-semibold">{{ rand(40,95) }}%</span>
                </div>
                <div class="progress-track mt-2 mb-3"><div class="progress-bar" style="width:{{ rand(40,95) }}%;background:var(--admin-primary);"></div></div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.inventory.index') }}" class="btn btn-sm btn-admin-outline flex-grow-1"><i class="bi bi-box me-1"></i> View Stock</a>
                    <button class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('admin.components.modal', ['id' => 'addWarehouseModal', 'title' => 'Tambah Warehouse Baru'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Warehouse <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Kode</label><input type="text" class="form-control" placeholder="Auto"></div>
        <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2" required></textarea></div>
        <div class="col-md-4"><label class="form-label">City</label><input type="text" class="form-control" required></div>
        <div class="col-md-4"><label class="form-label">Province</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Kapasitas (sqm)</label><input type="number" class="form-control"></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
