@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Marketing</a></li>
<li class="breadcrumb-item active">Testimonials</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addTestimonialModal"><i class="bi bi-plus-lg me-1"></i> Tambah Testimonial</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Testimonials</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="testimonialsTable">
            <thead><tr><th>Customer</th><th>Company</th><th>Rating</th><th>Content</th><th>Date</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,10) as $i)
                <tr>
                    <td class="fw-medium">Customer {{ $i }}</td>
                    <td>PT Perusahaan {{ $i }}</td>
                    <td><span class="text-warning">@for($j=0;$j<rand(3,5);$j++)<i class="bi bi-star-fill"></i>@endfor</span></td>
                    <td class="text-muted" style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">"Sangat puas dengan pelayanan dan kualitas produk dari Perusahaan Mesin Industri."</td>
                    <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i*10.' days')) }}</td>
                    <td><span class="badge-status bg-{{ $i % 5 == 0 ? 'pending' : 'completed' }}">{{ $i % 5 == 0 ? 'Pending' : 'Approved' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addTestimonialModal', 'title' => 'Tambah Testimonial'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Nama Customer <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Perusahaan</label><input type="text" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Rating</label><select class="form-select"><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option></select></div>
        <div class="col-md-6"><label class="form-label">Status</label><select class="form-select"><option>Approved</option><option>Pending</option></select></div>
        <div class="col-12"><label class="form-label">Testimonial <span class="text-danger">*</span></label><textarea class="form-control" rows="3" required></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#testimonialsTable').DataTable({ordering:true,pageLength:10,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'}});});</script>
@endpush
