@extends('layouts.admin')

@section('title', 'Dealers')
@section('page-title', 'Dealer Management')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Dealers</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addDealerModal"><i class="bi bi-plus-lg me-1"></i> Tambah Dealer</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Dealers</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="dealersTable">
            <thead><tr><th>Code</th><th>Company</th><th>Contact</th><th>City</th><th>Phone</th><th>Email</th><th>Tier</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,12) as $i)
                <tr>
                    <td class="fw-medium">DLR-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                    <td class="fw-medium">PT Dealer {{ $i }}</td>
                    <td>Contact {{ $i }}</td>
                    <td>{{ ['Jakarta','Surabaya','Bandung','Medan','Makassar','Semarang'][$i % 6] }}</td>
                    <td>021-{{ str_pad($i,5,'0',STR_PAD_LEFT) }}</td>
                    <td>dealer{{ $i }}@email.com</td>
                    <td><span class="badge bg-{{ ['gold','silver','bronze','platinum'][$i % 4] }} rounded-pill text-white">{{ ['Gold','Silver','Bronze','Platinum'][$i % 4] }}</span></td>
                    <td><span class="badge-status bg-{{ $i % 6 == 0 ? 'expired' : 'completed' }}">{{ $i % 6 == 0 ? 'Inactive' : 'Active' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addDealerModal', 'title' => 'Tambah Dealer Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Contact Person</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Phone</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Email</label><input type="email" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Tier</label><select class="form-select"><option>Platinum</option><option>Gold</option><option>Silver</option><option>Bronze</option></select></div>
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
<script>$(document).ready(function(){$('#dealersTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
