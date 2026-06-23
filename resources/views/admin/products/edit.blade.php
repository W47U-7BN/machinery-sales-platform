@extends('layouts.admin')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
<li class="breadcrumb-item active">Edit Excavator EC220D</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.products.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<form>
    <ul class="nav nav-tabs tab-nav-custom" id="productTabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-basic">Informasi Dasar</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-pricing">Harga & Status</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-specs">Spesifikasi</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-media">Media</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-seo">SEO</button></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-basic">
            <div class="admin-card">
                <div class="card-header"><h6>Informasi Dasar</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Product Name <span class="text-danger">*</span></label><input type="text" class="form-control" value="Excavator EC220D"></div>
                        <div class="col-md-3"><label class="form-label">SKU <span class="text-danger">*</span></label><input type="text" class="form-control" value="EC220D-STD"></div>
                        <div class="col-md-3"><label class="form-label">Barcode</label><input type="text" class="form-control" value="8991234567890"></div>
                        <div class="col-md-4"><label class="form-label">Category</label><select class="form-select"><option>Mesin Konstruksi</option><option>Mesin Pertanian</option></select></div>
                        <div class="col-md-4"><label class="form-label">Brand</label><select class="form-select"><option>Caterpillar</option><option>Komatsu</option></select></div>
                        <div class="col-md-4"><label class="form-label">Unit</label><select class="form-select"><option selected>Unit</option><option>Set</option></select></div>
                        <div class="col-12"><label class="form-label">Deskripsi</label><textarea class="form-control" rows="4">Excavator EC220D adalah excavator mid-size yang cocok untuk konstruksi dan pertambangan. Dilengkapi engine diesel 220 HP dan hydraulic system yang efisien.</textarea></div>
                        <div class="col-12"><label class="form-label">Short Description</label><textarea class="form-control" rows="2">Excavator mid-size 220 HP untuk konstruksi & pertambangan</textarea></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-pricing">
            <div class="admin-card">
                <div class="card-header"><h6>Harga & Status</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4"><label class="form-label">Harga Jual <span class="text-danger">*</span></label><div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="500000000"></div></div>
                        <div class="col-md-4"><label class="form-label">Harga Promo</label><div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="475000000"></div></div>
                        <div class="col-md-4"><label class="form-label">Harga Modal</label><div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="350000000"></div></div>
                        <div class="col-md-4"><label class="form-label">Status</label><select class="form-select"><option selected>Active</option><option>Inactive</option></select></div>
                        <div class="col-md-4"><label class="form-label">Featured Product</label><select class="form-select"><option>No</option><option selected>Yes</option></select></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-specs">
            <div class="admin-card">
                <div class="card-header">
                    <h6>Spesifikasi</h6>
                    <button class="btn btn-sm btn-admin-primary" type="button" onclick="addSpec()"><i class="bi bi-plus"></i> Add Spec</button>
                </div>
                <div class="card-body">
                    <div id="specsContainer">
                        <div class="row g-2 spec-row mb-2"><div class="col-4"><input type="text" class="form-control" value="Weight"></div><div class="col-4"><input type="text" class="form-control" value="12,500"></div><div class="col-3"><input type="text" class="form-control" value="kg"></div><div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div></div>
                        <div class="row g-2 spec-row mb-2"><div class="col-4"><input type="text" class="form-control" value="Dimensions"></div><div class="col-4"><input type="text" class="form-control" value="5.2 x 2.8 x 3.1"></div><div class="col-3"><input type="text" class="form-control" value="m"></div><div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div></div>
                        <div class="row g-2 spec-row mb-2"><div class="col-4"><input type="text" class="form-control" value="Engine Power"></div><div class="col-4"><input type="text" class="form-control" value="220"></div><div class="col-3"><input type="text" class="form-control" value="HP"></div><div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-media">
            <div class="admin-card">
                <div class="card-header"><h6>Media</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Product Images</label>
                            <div class="d-flex gap-2 flex-wrap mb-3">
                                <div style="width:100px;height:100px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px solid #ddd;position:relative;">
                                    <i class="bi bi-image text-muted fs-2"></i>
                                    <button class="btn btn-sm btn-danger position-absolute top-0 end-0" style="border-radius:50%;width:20px;height:20px;padding:0;font-size:10px;"><i class="bi bi-x"></i></button>
                                </div>
                                <div style="width:100px;height:100px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;border:2px dashed #ddd;cursor:pointer;"><i class="bi bi-plus text-muted fs-3"></i></div>
                            </div>
                        </div>
                        <div class="col-md-6"><label class="form-label">Video URL</label><input type="url" class="form-control" value="https://youtube.com/watch?v=xxxx"></div>
                        <div class="col-md-6"><label class="form-label">Video URL (Vimeo)</label><input type="url" class="form-control"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-seo">
            <div class="admin-card">
                <div class="card-header"><h6>SEO Settings</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12"><label class="form-label">Slug</label><div class="input-group"><span class="input-group-text">{{ url('/products/') }}/</span><input type="text" class="form-control" value="excavator-ec220d"></div></div>
                        <div class="col-12"><label class="form-label">Meta Title</label><input type="text" class="form-control" value="Excavator EC220D - Mesin Konstruksi Caterpillar"></div>
                        <div class="col-12"><label class="form-label">Meta Description</label><textarea class="form-control" rows="3">Excavator EC220D mid-size dari Caterpillar, cocok untuk konstruksi dan pertambangan dengan engine 220 HP dan hydraulic system efisien.</textarea></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-admin-light">Cancel</a>
        <button type="submit" class="btn btn-admin-primary btn-lg"><i class="bi bi-save me-1"></i> Update Product</button>
    </div>
</form>
@endsection

@push('scripts')
<script>function addSpec(){var e=document.createElement("div");e.className="row g-2 spec-row mb-2",e.innerHTML='<div class="col-4"><input type="text" class="form-control" placeholder="Attribute"></div><div class="col-4"><input type="text" class="form-control" placeholder="Value"></div><div class="col-3"><input type="text" class="form-control" placeholder="Unit"></div><div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest(\'.spec-row\').remove()"><i class="bi bi-x"></i></button></div>',document.getElementById("specsContainer").appendChild(e)}</script>
@endpush
