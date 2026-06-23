@extends('layouts.admin')

@section('title', 'Stock Movements')
@section('page-title', 'Stock Movement History')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.inventory.index') }}">Inventori</a></li>
<li class="breadcrumb-item active">Stock Movements</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.inventory.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back to Inventory</a>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Types</option><option>Stock In</option><option>Stock Out</option><option>Transfer</option><option>Adjustment</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Warehouses</option><option>Warehouse Utama</option><option>Warehouse Surabaya</option></select></div>
        <div style="min-width:180px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search product or reference..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>Movement History</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="movementsTable">
                <thead><tr><th>Date</th><th>Type</th><th>Product</th><th>Warehouse</th><th>Qty</th><th>Before</th><th>After</th><th>User</th><th>Reference</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    @php $type = ['in','out','transfer','adjustment'][$i % 4]; @endphp
                    <tr>
                        <td class="text-muted">{{ date('d/m/Y H:i', strtotime('-'.$i.' hours')) }}</td>
                        <td><span class="badge-status bg-{{ $type == 'in' ? 'completed' : ($type == 'out' ? 'rejected' : ($type == 'transfer' ? 'sent' : 'pending')) }}">{{ ucfirst($type) }}</span></td>
                        <td class="fw-medium">Product {{ $i }}</td>
                        <td>{{ ['Warehouse Utama','Warehouse Surabaya'][$i % 2] }}</td>
                        <td class="fw-semibold">{{ $type == 'out' ? '-'.rand(1,10) : '+'.rand(1,10) }}</td>
                        <td>{{ rand(10,100) }}</td>
                        <td>{{ rand(10,100) }}</td>
                        <td>User {{ chr(65+($i%5)) }}</td>
                        <td class="text-muted">REF-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 1,234 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">83</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#movementsTable').DataTable({ordering:true,searching:true,pageLength:25,lengthMenu:[[10,25,50,100,-1],[10,25,50,100,'All']],language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},order:[[0,'desc']]});});</script>
@endpush
