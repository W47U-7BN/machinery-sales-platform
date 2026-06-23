@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
<li class="breadcrumb-item active">Products</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.products.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> Tambah Product</a>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Categories</option><option>Mesin Konstruksi</option><option>Mesin Pertanian</option><option>Mesin Manufaktur</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Brands</option><option>Caterpillar</option><option>Komatsu</option><option>Hitachi</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>Active</option><option>Inactive</option></select></div>
        <div style="min-width:180px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search product..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
        <button class="btn btn-sm btn-admin-light" onclick="exportTable()"><i class="bi bi-download"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Products</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="productsTable">
                <thead><tr><th style="width:30px;"><input type="checkbox" class="form-check-input"></th><th>Image</th><th>SKU</th><th>Name</th><th>Category</th><th>Brand</th><th>Price</th><th>Stock</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    @php $products = ['Excavator EC220D','Bulldozer D6R','Crane RT100','Conveyor Belt 1200','Hydraulic Press 500T','Generator 2000W','Water Pump 300HP','CNC Milling Machine','Tractor LX90','Harvester X500','Forklift 3T','Compactor 20T','Mixer 1m3','Welding Machine 500A','Air Compressor 200L']; @endphp
                    <tr>
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td><div style="width:40px;height:40px;background:#e9ecef;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;color:#888;"><i class="bi bi-box"></i></div></td>
                        <td class="fw-medium">SKU-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                        <td><a href="#" class="text-decoration-none fw-medium">{{ $products[$i-1] }}</a></td>
                        <td>{{ ['Mesin Konstruksi','Mesin Pertanian','Mesin Manufaktur','Mesin Energi','Mesin Pengolahan'][$i % 5] }}</td>
                        <td>{{ ['Caterpillar','Komatsu','Hitachi','Kubota','Yanmar'][$i % 5] }}</td>
                        <td>Rp {{ number_format(rand(5000000,500000000),0,',','.') }}</td>
                        <td><span class="badge-status bg-{{ ['in-stock','low-stock','in-stock','out-of-stock','in-stock'][$i % 5] }}">{{ ['In Stock','Low Stock','In Stock','Out of Stock','In Stock'][$i % 5] }} ({{ rand(0,50) }})</span></td>
                        <td><span class="badge-status bg-{{ $i % 7 == 0 ? 'rejected' : 'completed' }}">{{ $i % 7 == 0 ? 'Inactive' : 'Active' }}</span></td>
                        <td><div class="action-btns"><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="{{ route('admin.products.edit', $i) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a><a href="#" onclick="return confirmDelete('#','product')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 234 products</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">16</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#productsTable').DataTable({ordering:true,searching:true,pageLength:25,lengthMenu:[[10,25,50,100,-1],[10,25,50,100,'All']],language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[0,1,9]}]});});</script>
@endpush
