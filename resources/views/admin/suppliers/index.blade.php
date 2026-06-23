@extends('layouts.admin')

@section('title', 'Suppliers')
@section('page-title', 'Suppliers Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.suppliers.index') }}">Pembelian</a></li>
<li class="breadcrumb-item active">Suppliers</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.suppliers.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> Tambah Supplier</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Suppliers</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="suppliersTable">
            <thead><tr><th>Code</th><th>Name</th><th>Contact Person</th><th>Phone</th><th>Email</th><th>City</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,15) as $i)
                <tr>
                    <td class="fw-medium">SUP-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                    <td><a href="{{ route('admin.suppliers.show', $i) }}" class="text-decoration-none fw-medium">PT Supplier {{ $i }}</a></td>
                    <td>Contact {{ $i }}</td>
                    <td>021-{{ str_pad($i,5,'0',STR_PAD_LEFT) }}</td>
                    <td>supplier{{ $i }}@email.com</td>
                    <td>{{ ['Jakarta','Tangerang','Bekasi','Bandung','Semarang'][$i % 5] }}</td>
                    <td><span class="badge-status bg-{{ $i % 6 == 0 ? 'expired' : 'completed' }}">{{ $i % 6 == 0 ? 'Inactive' : 'Active' }}</span></td>
                    <td><div class="action-btns"><a href="{{ route('admin.suppliers.show', $i) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="{{ route('admin.suppliers.edit', $i) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a><a href="#" onclick="return confirmDelete('#','supplier')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 78 suppliers</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">6</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#suppliersTable').DataTable({ordering:true,searching:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[7]}]});});</script>
@endpush
