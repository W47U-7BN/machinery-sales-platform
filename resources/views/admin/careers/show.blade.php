@extends('layouts.admin')

@section('title', 'Career Detail')
@section('page-title', 'Lowongan Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.careers.index') }}">Careers</a></li>
<li class="breadcrumb-item active">Sales Manager</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</button>
    <a href="{{ route('admin.careers.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Job Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6"><label class="text-muted small">Title</label><p class="fw-semibold fs-6">Sales Manager</p></div>
                    <div class="col-md-3"><label class="text-muted small">Department</label><p class="fw-semibold">Sales</p></div>
                    <div class="col-md-3"><label class="text-muted small">Location</label><p class="fw-semibold">Jakarta</p></div>
                    <div class="col-md-3"><label class="text-muted small">Type</label><p><span class="badge bg-light text-dark rounded-pill">Full Time</span></p></div>
                    <div class="col-md-3"><label class="text-muted small">Status</label><p><span class="badge-status bg-completed">Open</span></p></div>
                    <div class="col-md-3"><label class="text-muted small">Applicants</label><p class="fw-semibold">12 candidates</p></div>
                    <div class="col-md-3"><label class="text-muted small">Deadline</label><p class="fw-semibold">30 Jul 2026</p></div>
                    <div class="col-12"><label class="text-muted small">Description</label><p>We are looking for an experienced Sales Manager to lead our industrial machinery sales team. The ideal candidate will have strong leadership skills and deep knowledge of the construction and heavy equipment industry.</p></div>
                    <div class="col-12"><label class="text-muted small">Requirements</label><ul class="mb-0">
                        <li>Min. 5 years experience in industrial machinery sales</li>
                        <li>Proven track record of achieving sales targets</li>
                        <li>Strong network in construction/mining industry</li>
                        <li>Excellent communication and negotiation skills</li>
                        <li>Bachelor's degree in Engineering or Business</li>
                    </ul></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Applicants (12)</h6></div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach(range(1,5) as $i)
                    <div class="list-group-item list-group-item-action py-3">
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium small">Applicant {{ $i }}</span>
                            <span class="badge-status bg-{{ ['pending','sent','completed','rejected','processing'][$i-1] }}">{{ ['New','Reviewed','Shortlisted','Rejected','Interview'][$i-1] }}</span>
                        </div>
                        <small class="text-muted">applied {{ date('d/m/Y', strtotime('-'.$i.' days')) }}</small>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="#" class="text-decoration-none small">View All Applicants</a>
            </div>
        </div>
    </div>
</div>
@endsection
