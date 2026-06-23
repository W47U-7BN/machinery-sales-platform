@extends('layouts.admin')

@section('title', 'Careers')
@section('page-title', 'Career Management')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Careers</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addCareerModal"><i class="bi bi-plus-lg me-1"></i> Tambah Lowongan</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Job Vacancies</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="careersTable">
            <thead><tr><th>Title</th><th>Department</th><th>Location</th><th>Type</th><th>Applicants</th><th>Deadline</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,10) as $i)
                <tr>
                    <td class="fw-medium"><a href="{{ route('admin.careers.show', $i) }}" class="text-decoration-none">{{ ['Sales Manager','Mechanical Engineer','Service Technician','Marketing Specialist','Finance Officer','HR Coordinator','IT Support','Logistics Supervisor'][$i-1] }}</a></td>
                    <td>{{ ['Sales','Engineering','Service','Marketing','Finance','HRD','IT','Logistics'][$i-1] }}</td>
                    <td>{{ ['Jakarta','Surabaya','Bandung','Jakarta','Jakarta','Jakarta','Surabaya','Medan'][$i-1] }}</td>
                    <td><span class="badge bg-light text-dark rounded-pill">{{ ['Full Time','Full Time','Contract','Full Time','Full Time','Part Time','Full Time','Full Time'][$i-1] }}</span></td>
                    <td>{{ rand(3,50) }}</td>
                    <td class="text-muted">{{ date('d/m/Y', strtotime('+'.rand(10,60).' days')) }}</td>
                    <td><span class="badge-status bg-{{ $i % 3 == 0 ? 'rejected' : 'completed' }}">{{ $i % 3 == 0 ? 'Closed' : 'Open' }}</span></td>
                    <td><div class="action-btns"><a href="{{ route('admin.careers.show', $i) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 10 of 10 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>

@include('admin.components.modal', ['id' => 'addCareerModal', 'title' => 'Tambah Lowongan Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-8"><label class="form-label">Job Title <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-4"><label class="form-label">Department</label><select class="form-select"><option>Sales</option><option>Engineering</option><option>Service</option><option>Marketing</option><option>Finance</option></select></div>
        <div class="col-md-4"><label class="form-label">Location</label><input type="text" class="form-control"></div>
        <div class="col-md-4"><label class="form-label">Employment Type</label><select class="form-select"><option>Full Time</option><option>Part Time</option><option>Contract</option><option>Internship</option></select></div>
        <div class="col-md-4"><label class="form-label">Deadline</label><input type="date" class="form-control"></div>
        <div class="col-12"><label class="form-label">Description <span class="text-danger">*</span></label><textarea class="form-control" rows="5" required></textarea></div>
        <div class="col-12"><label class="form-label">Requirements</label><textarea class="form-control" rows="3"></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#careersTable').DataTable({ordering:true,pageLength:10,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'}});});</script>
@endpush
