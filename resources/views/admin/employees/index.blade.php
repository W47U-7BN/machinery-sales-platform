@extends('layouts.admin')

@section('title', 'Employees')
@section('page-title', 'Employees Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">SDM</a></li>
<li class="breadcrumb-item active">Employees</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.employees.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> Tambah Karyawan</a>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Departments</option><option>Sales</option><option>Marketing</option><option>Engineering</option><option>Service</option><option>Finance</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>Active</option><option>Inactive</option></select></div>
        <div style="min-width:180px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search employee..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Employees</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="employeesTable">
                <thead><tr><th>NIK</th><th>Name</th><th>Department</th><th>Position</th><th>Email</th><th>Phone</th><th>Join Date</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td class="fw-medium">NIK-{{ str_pad($i,5,'0',STR_PAD_LEFT) }}</td>
                        <td><a href="#" class="text-decoration-none fw-medium">Karyawan {{ $i }}</a></td>
                        <td>{{ ['Sales','Marketing','Engineering','Service','Finance','HRD','Logistics'][$i % 7] }}</td>
                        <td>{{ ['Staff','Supervisor','Manager','Director','Team Lead','Analyst','Coordinator'][$i % 7] }}</td>
                        <td>emp{{ $i }}@company.com</td>
                        <td>0812-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}-0000</td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.rand(30,1000).' days')) }}</td>
                        <td><span class="badge-status bg-{{ $i % 8 == 0 ? 'expired' : 'completed' }}">{{ $i % 8 == 0 ? 'Inactive' : 'Active' }}</span></td>
                        <td><div class="action-btns"><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="{{ route('admin.employees.edit', $i) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a><a href="#" onclick="return confirmDelete('#','employee')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 128 employees</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">9</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#employeesTable').DataTable({ordering:true,searching:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
