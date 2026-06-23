@extends('layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Penjualan</a></li>
<li class="breadcrumb-item active">Orders</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.quotations.index') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> New Order</a>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>Pending</option><option>Processing</option><option>Sent</option><option>Completed</option><option>Cancelled</option></select></div>
        <div style="min-width:200px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search order or customer..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Orders</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="ordersTable">
                <thead><tr><th>#Order</th><th>Customer</th><th>Sales</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td><a href="{{ route('admin.orders.show', $i) }}" class="fw-medium text-decoration-none">ORD-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                        <td>PT Customer {{ $i }}</td>
                        <td>Sales {{ chr(64+($i%3+1)) }}</td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</td>
                        <td>{{ rand(1,15) }}</td>
                        <td>Rp {{ number_format(rand(5000000,200000000),0,',','.') }}</td>
                        <td><span class="badge-status bg-{{ ['pending','processing','sent','completed','cancelled','on-hold','processing'][$i%7] }}">{{ ['Pending','Processing','Sent','Completed','Cancelled','On Hold','Processing'][$i%7] }}</span></td>
                        <td><div class="action-btns"><a href="{{ route('admin.orders.show', $i) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a><a href="#" onclick="return confirmDelete('#','order')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 567 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">38</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#ordersTable').DataTable({ordering:true,searching:true,pageLength:25,lengthMenu:[[10,25,50,100,-1],[10,25,50,100,'All']],language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[7]}]});});</script>
@endpush
