@extends('layouts.admin')

@section('title', 'Inventory')
@section('page-title', 'Inventory Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.inventory.index') }}">Inventori</a></li>
<li class="breadcrumb-item active">Inventory</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.inventory.transfer') }}" class="btn btn-admin-accent"><i class="bi bi-arrow-left-right me-1"></i> Transfer Stock</a>
<a href="{{ route('admin.inventory.movements') }}" class="btn btn-admin-outline"><i class="bi bi-clock-history me-1"></i> Movements</a>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Warehouses</option><option>Warehouse Utama</option><option>Warehouse Surabaya</option><option>Warehouse Bandung</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>In Stock</option><option>Low Stock</option><option>Out of Stock</option></select></div>
        <div style="min-width:180px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search product..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>Stock Inventory</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="inventoryTable">
                <thead><tr><th>Product</th><th>SKU</th><th>Warehouse</th><th>Rack</th><th>Quantity</th><th>Min Qty</th><th>Status</th><th>Last Movement</th><th style="width:80px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    @php $qty = rand(0,50); $min = rand(2,10); @endphp
                    <tr>
                        <td class="fw-medium">Product {{ $i }}</td>
                        <td>SKU-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                        <td>{{ ['Warehouse Utama','Warehouse Surabaya','Warehouse Bandung'][$i % 3] }}</td>
                        <td>R-{{ chr(64+($i%5+1)) }}-{{ str_pad($i,3,'0',STR_PAD_LEFT) }}</td>
                        <td class="fw-semibold">{{ $qty }}</td>
                        <td>{{ $min }}</td>
                        <td><span class="badge-status bg-{{ $qty == 0 ? 'out-of-stock' : ($qty <= $min ? 'low-stock' : 'in-stock') }}">{{ $qty == 0 ? 'Out of Stock' : ($qty <= $min ? 'Low Stock' : 'In Stock') }}</span></td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</td>
                        <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary" title="Adjust"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-info" title="History"><i class="bi bi-clock-history"></i></button></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 234 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">16</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#inventoryTable').DataTable({ordering:true,searching:true,pageLength:25,lengthMenu:[[10,25,50,100,-1],[10,25,50,100,'All']],language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
