@extends('layouts.admin')

@section('title', 'Media Library')
@section('page-title', 'Media Library')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.media.index') }}">System</a></li>
<li class="breadcrumb-item active">Media</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent"><i class="bi bi-upload me-1"></i> Upload Media</button>
</div>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Types</option><option>Images</option><option>Documents</option><option>Videos</option></select></div>
        <div style="min-width:200px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search media..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>Media Library</h6></div>
    <div class="card-body">
        <div class="row g-3">
            @foreach(range(1,12) as $i)
            <div class="col-md-3 col-6">
                <div class="stat-card text-center p-2" style="cursor:pointer;">
                    <div style="height:120px;background:linear-gradient(135deg,#e9ecef,#dee2e6);border-radius:8px;margin-bottom:8px;display:flex;align-items:center;justify-content:center;font-size:32px;color:#adb5bd;">
                        <i class="bi bi-{{ $i % 3 == 0 ? 'file-earmark-pdf' : ($i % 3 == 1 ? 'image' : 'file-earmark') }}"></i>
                    </div>
                    <div class="small text-truncate fw-medium">media_{{ $i }}.{{ ['jpg','png','pdf','docx','mp4'][$i % 5] }}</div>
                    <small class="text-muted">{{ rand(100,5000) }} KB</small>
                    <div class="mt-1"><button class="btn btn-sm btn-outline-danger" style="width:24px;height:24px;padding:0;font-size:10px;"><i class="bi bi-x"></i></button></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mt-3"><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#">Prev</a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">Next</a></li></ul></nav></div>
@endsection
