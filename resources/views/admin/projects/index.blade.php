@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Layanan</a></li>
<li class="breadcrumb-item active">Projects</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addProjectModal"><i class="bi bi-plus-lg me-1"></i> New Project</button>
@endsection

@section('content')
<div class="row g-4">
    @foreach(range(1,6) as $i)
    <div class="col-xl-4 col-md-6">
        <div class="admin-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-1">Project Alpha {{ $i }}</h6>
                        <small class="text-muted">
                            <i class="bi bi-building me-1"></i> PT Customer {{ $i }} |
                            <i class="bi bi-calendar me-1 ms-2"></i> {{ date('d/m/Y', strtotime('-'.$i*10.' days')) }}
                        </small>
                    </div>
                    <span class="badge-status bg-{{ ['in-progress','completed','processing','in-progress','completed','pending'][$i-1] }}">{{ ['In Progress','Completed','On Hold','In Progress','Completed','Planning'][$i-1] }}</span>
                </div>
                <p class="small text-muted mb-3">Installation and configuration of conveyor system for new warehouse facility.</p>
                <div class="d-flex justify-content-between small mb-1"><span class="text-muted">Progress</span><span class="fw-semibold">{{ rand(20,100) }}%</span></div>
                <div class="progress-track mb-3"><div class="progress-bar bg-success" style="width:{{ rand(20,100) }}%"></div></div>
                <div class="d-flex justify-content-between small mb-1"><span class="text-muted">Value</span><span class="fw-semibold">Rp {{ number_format(rand(50000000,500000000),0,',','.') }}</span></div>
                <div class="d-flex justify-content-between small mb-1"><span class="text-muted">Tasks</span><span class="fw-semibold">{{ rand(5,30) }} tasks</span></div>
                <hr class="my-2">
                <a href="{{ route('admin.projects.show', $i) }}" class="btn btn-sm btn-admin-outline w-100"><i class="bi bi-eye me-1"></i> View Project</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@include('admin.components.modal', ['id' => 'addProjectModal', 'title' => 'Buat Project Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Project Name <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Customer <span class="text-danger">*</span></label><select class="form-select" required><option>Select customer</option><option>PT Maju Jaya</option></select></div>
        <div class="col-md-4"><label class="form-label">Start Date</label><input type="date" class="form-control" value="{{ date('Y-m-d') }}"></div>
        <div class="col-md-4"><label class="form-label">End Date</label><input type="date" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Status</label><select class="form-select"><option>Planning</option><option>In Progress</option><option>On Hold</option><option>Completed</option></select></div>
        <div class="col-12"><label class="form-label">Description</label><textarea class="form-control" rows="3"></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Create Project</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
