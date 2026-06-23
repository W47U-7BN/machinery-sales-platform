@extends('layouts.admin')

@section('title', 'Create Product')
@section('page-title', 'Tambah Product Baru')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Produk</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
<li class="breadcrumb-item active">Tambah Baru</li>
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
                        <div class="col-md-6">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required>
                            <div class="invalid-feedback">Nama product wajib diisi.</div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">SKU <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option>Select category</option>
                                <option>Mesin Konstruksi</option>
                                <option>Mesin Pertanian</option>
                                <option>Mesin Manufaktur</option>
                                <option>Mesin Energi</option>
                                <option>Mesin Pengolahan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option>Select brand</option>
                                <option>Caterpillar</option>
                                <option>Komatsu</option>
                                <option>Hitachi</option>
                                <option>Kubota</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit</label>
                            <select class="form-select">
                                <option>Unit</option>
                                <option>Set</option>
                                <option>Piece</option>
                                <option>Meter</option>
                                <option>Kg</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="4" placeholder="Product description..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control" rows="2" placeholder="Brief description for cards/listings" maxlength="200"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-pricing">
            <div class="admin-card">
                <div class="card-header"><h6>Harga & Status</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Harga Jual <span class="text-danger">*</span></label>
                            <div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="0"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Promo</label>
                            <div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" placeholder="Optional"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Harga Modal (Cost)</label>
                            <div class="input-group"><span class="input-group-text">Rp</span><input type="text" class="form-control" value="0"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Draft</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Featured Product</label>
                            <select class="form-select">
                                <option>No</option>
                                <option>Yes</option>
                            </select>
                        </div>
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
                    <div class="row g-3" id="specsContainer">
                        <div class="row g-2 spec-row mb-2">
                            <div class="col-4"><input type="text" class="form-control" placeholder="Attribute" value="Weight"></div>
                            <div class="col-4"><input type="text" class="form-control" placeholder="Value" value="12,500 kg"></div>
                            <div class="col-3"><input type="text" class="form-control" placeholder="Unit" value="kg"></div>
                            <div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div>
                        </div>
                        <div class="row g-2 spec-row mb-2">
                            <div class="col-4"><input type="text" class="form-control" placeholder="Attribute" value="Dimensions"></div>
                            <div class="col-4"><input type="text" class="form-control" placeholder="Value" value="5.2 x 2.8 x 3.1"></div>
                            <div class="col-3"><input type="text" class="form-control" placeholder="Unit" value="m"></div>
                            <div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div>
                        </div>
                        <div class="row g-2 spec-row mb-2">
                            <div class="col-4"><input type="text" class="form-control" placeholder="Attribute" value="Power"></div>
                            <div class="col-4"><input type="text" class="form-control" placeholder="Value" value="220"></div>
                            <div class="col-3"><input type="text" class="form-control" placeholder="Unit" value="HP"></div>
                            <div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div>
                        </div>
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
                            <div class="image-upload-wrapper">
                                <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                <div class="upload-text">Drag & drop images here or click to browse</div>
                                <div class="upload-hint">Supported: JPG, PNG, WEBP. Max 5MB each.</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-2 flex-wrap">
                                <div style="width:100px;height:100px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;border:2px dashed #ddd;cursor:pointer;"><i class="bi bi-plus text-muted fs-3"></i></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Video URL (YouTube)</label>
                            <input type="url" class="form-control" placeholder="https://youtube.com/watch?v=...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Video URL (Vimeo)</label>
                            <input type="url" class="form-control" placeholder="https://vimeo.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Document Uploads</label>
                            <div class="image-upload-wrapper">
                                <div class="upload-icon"><i class="bi bi-file-earmark-arrow-up"></i></div>
                                <div class="upload-text">Upload specification sheets, manuals, etc.</div>
                                <div class="upload-hint">Supported: PDF, DOC, XLS. Max 20MB.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="tab-seo">
            <div class="admin-card">
                <div class="card-header"><h6>SEO Settings</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Slug</label>
                            <div class="input-group"><span class="input-group-text">{{ url('/products/') }}/</span><input type="text" class="form-control" placeholder="product-slug"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" placeholder="SEO title (defaults to product name)">
                            <div class="form-text">Recommended: 50-60 characters</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" rows="3" placeholder="SEO description (defaults to short description)"></textarea>
                            <div class="form-text">Recommended: 150-160 characters</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-admin-light">Cancel</a>
        <button type="submit" class="btn btn-admin-primary btn-lg"><i class="bi bi-save me-1"></i> Simpan Product</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
function addSpec() {
    const row = document.createElement('div');
    row.className = 'row g-2 spec-row mb-2';
    row.innerHTML = `
        <div class="col-4"><input type="text" class="form-control" placeholder="Attribute"></div>
        <div class="col-4"><input type="text" class="form-control" placeholder="Value"></div>
        <div class="col-3"><input type="text" class="form-control" placeholder="Unit"></div>
        <div class="col-1"><button class="btn btn-sm btn-outline-danger" type="button" onclick="this.closest('.spec-row').remove()"><i class="bi bi-x"></i></button></div>`;
    document.getElementById('specsContainer').appendChild(row);
}
</script>
@endpush
