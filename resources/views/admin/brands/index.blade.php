@extends('layouts.admin')

@section('title', 'Brands')
@section('page-title', 'Brands Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Produk</a></li>
<li class="breadcrumb-item active">Brands</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addBrandModal"><i class="bi bi-plus-lg me-1"></i> Tambah Brand</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Brands</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="brandsTable">
            <thead><tr><th>Logo</th><th>Name</th><th>Slug</th><th>Products</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(['Caterpillar','Komatsu','Hitachi','Kubota','Yanmar','Sany','Liebherr','Volvo'] as $i => $brand)
                <tr>
                    <td><div style="width:40px;height:40px;background:var(--admin-primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;">{{ substr($brand,0,2) }}</div></td>
                    <td class="fw-medium">{{ $brand }}</td>
                    <td class="text-muted">{{ Str::slug($brand) }}</td>
                    <td>{{ rand(3,30) }}</td>
                    <td><span class="badge-status bg-completed">Active</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger" onclick="return confirmDelete('#','brand')"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addBrandModal', 'title' => 'Tambah Brand Baru'])
<form>
    <div class="mb-3"><label class="form-label">Brand Name <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Slug</label><input type="text" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Logo</label><input type="file" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" rows="2"></textarea></div>
    <div class="d-flex justify-content-end gap-2"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
