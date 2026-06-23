@extends('layouts.admin')

@section('title', 'Vendors')
@section('page-title', 'Vendor Management')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Vendors</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addVendorModal"><i class="bi bi-plus-lg me-1"></i> Tambah Vendor</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Vendors</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="vendorsTable">
            <thead><tr><th>Code</th><th>Company</th><th>Category</th><th>Contact</th><th>Phone</th><th>Email</th><th>City</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,12) as $i)
                <tr>
                    <td class="fw-medium">VEN-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                    <td class="fw-medium">PT Vendor {{ $i }}</td>
                    <td>{{ ['Spare Parts','Raw Materials','Services','Logistics','IT Solutions'][$i % 5] }}</td>
                    <td>Contact {{ $i }}</td>
                    <td>021-{{ str_pad($i,5,'0',STR_PAD_LEFT) }}</td>
                    <td>vendor{{ $i }}@email.com</td>
                    <td>{{ ['Jakarta','Tangerang','Bekasi','Bandung','Surabaya'][$i % 5] }}</td>
                    <td><span class="badge-status bg-{{ $i % 7 == 0 ? 'expired' : 'completed' }}">{{ $i % 7 == 0 ? 'Inactive' : 'Active' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addVendorModal', 'title' => 'Tambah Vendor Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Kategori</label><select class="form-select"><option>Spare Parts</option><option>Raw Materials</option><option>Services</option><option>Logistics</option></select></div>
        <div class="col-md-4"><label class="form-label">Contact Person</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Phone</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Email</label><input type="email" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">City</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Province</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
        <div class="col-12"><label class="form-label">Alamat</label><textarea class="form-control" rows="2"></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#vendorsTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
