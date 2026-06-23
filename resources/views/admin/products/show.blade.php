@extends('layouts.admin')

@section('title', 'Product Detail')
@section('page-title', 'Product Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
<li class="breadcrumb-item active">Excavator EC220D</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <a href="{{ route('admin.products.edit', 1) }}" class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Product Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="text-muted small">Product Name</label><p class="fw-semibold fs-6">Excavator EC220D</p></div>
                    <div class="col-md-4"><label class="text-muted small">SKU</label><p class="fw-semibold">EC220D-STD</p></div>
                    <div class="col-md-4"><label class="text-muted small">Barcode</label><p class="fw-semibold">8991234567890</p></div>
                    <div class="col-md-4"><label class="text-muted small">Category</label><p class="fw-semibold">Mesin Konstruksi</p></div>
                    <div class="col-md-4"><label class="text-muted small">Brand</label><p class="fw-semibold">Caterpillar</p></div>
                    <div class="col-md-4"><label class="text-muted small">Unit</label><p class="fw-semibold">Unit</p></div>
                    <div class="col-12"><label class="text-muted small">Description</label><p>Excavator EC220D adalah excavator mid-size yang cocok untuk konstruksi dan pertambangan. Dilengkapi engine diesel 220 HP dan hydraulic system yang efisien.</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Spesifikasi</h6></div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-4"><small class="text-muted">Weight</small><p class="fw-medium">12,500 kg</p></div>
                    <div class="col-4"><small class="text-muted">Dimensions</small><p class="fw-medium">5.2 x 2.8 x 3.1 m</p></div>
                    <div class="col-4"><small class="text-muted">Engine Power</small><p class="fw-medium">220 HP</p></div>
                    <div class="col-4"><small class="text-muted">Bucket Capacity</small><p class="fw-medium">1.2 m3</p></div>
                    <div class="col-4"><small class="text-muted">Max Reach</small><p class="fw-medium">9.8 m</p></div>
                    <div class="col-4"><small class="text-muted">Fuel Tank</small><p class="fw-medium">400 L</p></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Pricing</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Harga Jual</span><span class="fw-bold fs-5" style="color:var(--admin-primary);">Rp 500.000.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Harga Promo</span><span class="fw-medium text-success">Rp 475.000.000</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Harga Modal</span><span class="fw-medium">Rp 350.000.000</span></div>
                <hr>
                <div class="d-flex justify-content-between"><span class="text-muted">Status</span><span class="badge-status bg-completed">Active</span></div>
                <div class="d-flex justify-content-between mt-2"><span class="text-muted">Featured</span><span class="badge-status bg-completed">Yes</span></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Stock Summary</h6></div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Total Stock</span><span class="fw-bold">12 Units</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Warehouse Utama</span><span class="fw-medium">8</span></div>
                <div class="d-flex justify-content-between mb-2"><span class="text-muted">Warehouse Surabaya</span><span class="fw-medium">4</span></div>
                <div class="mt-3"><span class="badge-status bg-in-stock">In Stock</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
