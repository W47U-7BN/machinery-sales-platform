@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Produk</a></li>
<li class="breadcrumb-item active">Categories</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="bi bi-plus-lg me-1"></i> Tambah Category</button>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>All Categories</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0" id="categoriesTable">
                    <thead><tr><th>Name</th><th>Slug</th><th>Parent</th><th>Products</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
                    <tbody>
                        @foreach(['Mesin Konstruksi','Mesin Pertanian','Mesin Manufaktur','Mesin Energi','Mesin Pengolahan','Sistem Otomasi','Suku Cadang','Alat Ukur'] as $i => $cat)
                        <tr>
                            <td class="fw-medium"><i class="bi bi-folder me-2 text-primary"></i>{{ $cat }}</td>
                            <td class="text-muted">{{ Str::slug($cat) }}</td>
                            <td>{{ $i < 2 ? '-' : 'Mesin Konstruksi' }}</td>
                            <td>{{ rand(5,50) }}</td>
                            <td><span class="badge-status bg-completed">Active</span></td>
                            <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Category Tree</h6></div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-folder-fill text-primary me-2"></i> Mesin Konstruksi
                        <ul class="list-unstyled ms-4 mt-1">
                            <li class="mb-1"><i class="bi bi-folder me-2 text-warning"></i> Excavator</li>
                            <li class="mb-1"><i class="bi bi-folder me-2 text-warning"></i> Bulldozer</li>
                            <li class="mb-1"><i class="bi bi-folder me-2 text-warning"></i> Crane</li>
                        </ul>
                    </li>
                    <li class="mb-2"><i class="bi bi-folder-fill text-primary me-2"></i> Mesin Pertanian</li>
                    <li class="mb-2"><i class="bi bi-folder-fill text-primary me-2"></i> Mesin Manufaktur</li>
                    <li class="mb-2"><i class="bi bi-folder-fill text-primary me-2"></i> Mesin Energi</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addCategoryModal', 'title' => 'Tambah Category Baru'])
<form>
    <div class="mb-3"><label class="form-label">Category Name <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Slug</label><input type="text" class="form-control" placeholder="Auto-generated if empty"></div>
    <div class="mb-3"><label class="form-label">Parent Category</label><select class="form-select"><option>None (Root)</option><option>Mesin Konstruksi</option><option>Mesin Pertanian</option></select></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" rows="2"></textarea></div>
    <div class="d-flex justify-content-end gap-2"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
