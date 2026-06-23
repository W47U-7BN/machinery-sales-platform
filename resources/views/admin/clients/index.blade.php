@extends('layouts.admin')

@section('title', 'Clients')
@section('page-title', 'Clients Management')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Clients</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addClientModal"><i class="bi bi-plus-lg me-1"></i> Tambah Client</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Clients</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="clientsTable">
            <thead><tr><th>Client ID</th><th>Name</th><th>Company</th><th>Email</th><th>Phone</th><th>Type</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,15) as $i)
                <tr>
                    <td class="fw-medium">CLT-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                    <td><a href="#" class="text-decoration-none fw-medium">Client {{ $i }}</a></td>
                    <td>PT Perusahaan {{ $i }}</td>
                    <td>client{{ $i }}@email.com</td>
                    <td>021-{{ str_pad($i,5,'0',STR_PAD_LEFT) }}</td>
                    <td>{{ ['Corporate','Individual','Government','Institution'][$i % 4] }}</td>
                    <td><span class="badge-status bg-{{ $i % 5 == 0 ? 'expired' : 'completed' }}">{{ $i % 5 == 0 ? 'Inactive' : 'Active' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addClientModal', 'title' => 'Tambah Client Baru'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Perusahaan</label><input type="text" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input type="text" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Type</label><select class="form-select"><option>Corporate</option><option>Individual</option><option>Government</option></select></div>
        <div class="col-md-6"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#clientsTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[7]}]});});</script>
@endpush
