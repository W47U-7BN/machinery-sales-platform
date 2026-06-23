@extends('layouts.admin')

@section('title', 'Roles')
@section('page-title', 'Roles & Permissions')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">System</a></li>
<li class="breadcrumb-item active">Roles</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addRoleModal"><i class="bi bi-plus-lg me-1"></i> Tambah Role</button>
@endsection

@section('content')
<div class="row g-4">
    @foreach(['Super Admin','Admin','Editor','Viewer','Sales Manager','Support Agent'] as $i => $role)
    <div class="col-xl-4 col-md-6">
        <div class="admin-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $role }}</h6>
                        <small class="text-muted">{{ rand(1,10) }} users</small>
                    </div>
                    @if($i == 0)
                    <span class="badge bg-primary rounded-pill px-2">Default</span>
                    @endif
                </div>
                <div class="mb-3">
                    <small class="text-muted d-block mb-1">Permissions:</small>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach(['Read','Write','Create','Delete','Export','Import'] as $p)
                        <span class="badge bg-{{ $i <= 1 ? 'success' : ($i == 2 ? 'info' : 'light text-dark') }} rounded-pill">{{ $p }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-admin-outline flex-grow-1"><i class="bi bi-shield me-1"></i> Permissions</button>
                    <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                    @if($i > 0)
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('admin.components.modal', ['id' => 'addRoleModal', 'title' => 'Tambah Role Baru'])
<form>
    <div class="mb-3"><label class="form-label">Role Name <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" rows="2"></textarea></div>
    <div class="mb-3"><label class="fw-semibold">Permissions</label>
        <div class="row g-2 mt-2">
            @foreach(['Read','Write','Create','Delete','Export','Import','Manage Users','Manage Settings'] as $perm)
            <div class="col-6"><div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label small">{{ $perm }}</label></div></div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-3"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
