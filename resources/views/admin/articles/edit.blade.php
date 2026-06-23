@extends('layouts.admin')

@section('title', 'Edit Article')
@section('page-title', 'Edit Artikel')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Marketing</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Articles</a></li>
<li class="breadcrumb-item active">Edit: Tips Memilih Excavator</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.articles.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<form>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header"><h6>Article Content</h6></div>
                <div class="card-body">
                    <div class="mb-3"><label class="form-label">Title <span class="text-danger">*</span></label><input type="text" class="form-control" value="Tips Memilih Excavator untuk Proyek Konstruksi"></div>
                    <div class="mb-3"><label class="form-label">Slug</label><div class="input-group"><span class="input-group-text">{{ url('/articles/') }}/</span><input type="text" class="form-control" value="tips-memilih-excavator"></div></div>
                    <div class="mb-3"><label class="form-label">Content</label><textarea class="form-control" rows="12">Memilih excavator yang tepat untuk proyek konstruksi adalah keputusan penting yang mempengaruhi efisiensi dan biaya operasional. Berikut adalah beberapa tips...</textarea></div>
                    <div class="mb-3"><label class="form-label">Excerpt</label><textarea class="form-control" rows="2" maxlength="300">Panduan lengkap memilih excavator untuk proyek konstruksi Anda.</textarea></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header"><h6>Settings</h6></div>
                <div class="card-body">
                    <div class="mb-3"><label class="form-label">Category</label><select class="form-select"><option selected>Tips</option><option>Maintenance</option><option>Teknologi</option></select></div>
                    <div class="mb-3"><label class="form-label">Status</label><select class="form-select"><option>Draft</option><option selected>Published</option></select></div>
                    <div class="mb-3"><label class="form-label">Featured Image</label><div class="image-upload-wrapper" style="padding:20px;"><div class="upload-icon" style="font-size:24px;"><i class="bi bi-image"></i></div><div class="upload-text small">Click to change</div></div></div>
                    <div class="mb-3"><label class="form-label">Meta Title</label><input type="text" class="form-control" value="Tips Memilih Excavator untuk Proyek Konstruksi"></div>
                    <div class="mb-3"><label class="form-label">Meta Description</label><textarea class="form-control" rows="2">Panduan lengkap memilih excavator yang tepat untuk proyek konstruksi Anda.</textarea></div>
                    <div class="mb-3"><label class="form-label">Tags</label><input type="text" class="form-control" value="excavator, konstruksi, alat berat, tips"></div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-admin-primary"><i class="bi bi-save me-1"></i> Update</button>
            </div>
        </div>
    </div>
</form>
@endsection
