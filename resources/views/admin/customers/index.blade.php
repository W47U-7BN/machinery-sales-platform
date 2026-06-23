@extends('layouts.admin')

@section('title', 'Customers')
@section('page-title', 'Customers Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">CRM</a></li>
<li class="breadcrumb-item active">Customers</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
    <i class="bi bi-plus-lg me-1"></i> Tambah Customer
</button>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search customers..."></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option value="">All Cities</option><option>Jakarta</option><option>Surabaya</option><option>Bandung</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option value="">All Statuses</option><option>Active</option><option>Inactive</option><option>Blacklist</option></select></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h6>All Customers</h6>
        <button class="btn btn-sm btn-admin-light" onclick="exportTable()"><i class="bi bi-download me-1"></i> Export</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="customersTable">
                <thead>
                    <tr><th>Code</th><th>Name</th><th>Company</th><th>Phone</th><th>Email</th><th>City</th><th>Total Orders</th><th>Outstanding</th><th>Status</th><th style="width:100px;">Actions</th></tr>
                </thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td><a href="{{ route('admin.customers.show', $i) }}" class="text-decoration-none fw-medium">CUS-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                        <td><a href="{{ route('admin.customers.show', $i) }}" class="text-decoration-none">Customer {{ $i }}</a></td>
                        <td>PT Perusahaan {{ $i }}</td>
                        <td>0812-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}-0000</td>
                        <td>customer{{ $i }}@email.com</td>
                        <td>{{ ['Jakarta','Surabaya','Bandung','Medan','Semarang'][$i % 5] }}</td>
                        <td>{{ rand(1,50) }}</td>
                        <td>Rp {{ number_format(rand(0,50000000),0,',','.') }}</td>
                        <td><span class="badge-status bg-{{ $i % 7 == 0 ? 'rejected' : ($i % 5 == 0 ? 'expired' : 'completed') }}">{{ $i % 7 == 0 ? 'Inactive' : ($i % 5 == 0 ? 'Blacklist' : 'Active') }}</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.customers.show', $i) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="#" onclick="return confirmDelete('#', 'customer')" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted small">Showing 1 to 15 of 1,245 entries</div>
    <nav><ul class="pagination pagination-sm mb-0">
        <li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="#">84</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
    </ul></nav>
</div>

@include('admin.components.modal', ['id' => 'addCustomerModal', 'title' => 'Tambah Customer Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Lengkap <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Perusahaan</label><input type="text" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Email <span class="text-danger">*</span></label><input type="email" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">No. Telepon <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-4"><label class="form-label">City</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Province</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Status</label><select class="form-select"><option>Active</option><option>Inactive</option><option>Blacklist</option></select></div>
        <div class="col-12"><label class="form-label">Address</label><textarea class="form-control" rows="2"></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-admin-primary">Simpan Customer</button>
    </div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#customersTable').DataTable({
        ordering: true, searching: true, pageLength: 25,
        lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'All']],
        language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: [9] }]
    });
});
</script>
@endpush
