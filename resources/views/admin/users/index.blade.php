@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">System</a></li>
<li class="breadcrumb-item active">Users</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="bi bi-plus-lg me-1"></i> Tambah User</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Users</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="usersTable">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Department</th><th>Last Login</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,12) as $i)
                <tr>
                    <td class="fw-medium"><div class="d-flex align-items-center gap-2"><div style="width:32px;height:32px;background:var(--admin-primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:600;">{{ chr(64+$i) }}</div>User {{ $i }}</div></td>
                    <td>user{{ $i }}@company.com</td>
                    <td><span class="badge bg-{{ ['primary','info','success','warning'][$i % 4] }} rounded-pill px-2">{{ ['Super Admin','Admin','Editor','Viewer'][$i % 4] }}</span></td>
                    <td>{{ ['Sales','Marketing','Engineering','Service','Finance','HRD'][$i % 6] }}</td>
                    <td class="text-muted">{{ date('d/m/Y H:i', strtotime('-'.rand(0,10).' hours')) }}</td>
                    <td><span class="badge-status bg-{{ $i % 7 == 0 ? 'expired' : 'completed' }}">{{ $i % 7 == 0 ? 'Inactive' : 'Active' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addUserModal', 'title' => 'Tambah User Baru'])
<form>
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-12"><label class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control" required></div>
        <div class="col-6"><label class="form-label">Password <span class="text-danger">*</span></label><input type="password" class="form-control" required></div>
        <div class="col-6"><label class="form-label">Confirm Password <span class="text-danger">*</span></label><input type="password" class="form-control" required></div>
        <div class="col-6"><label class="form-label">Role</label><select class="form-select"><option>Super Admin</option><option>Admin</option><option>Editor</option><option>Viewer</option></select></div>
        <div class="col-6"><label class="form-label">Department</label><select class="form-select"><option>Sales</option><option>Marketing</option><option>Engineering</option><option>Service</option></select></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#usersTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[6]}]});});</script>
@endpush
