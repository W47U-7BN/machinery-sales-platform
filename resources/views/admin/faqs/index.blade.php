@extends('layouts.admin')

@section('title', 'FAQs')
@section('page-title', 'FAQ Management')

@section('breadcrumb-items')
<li class="breadcrumb-item active">FAQs</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addFaqModal"><i class="bi bi-plus-lg me-1"></i> Tambah FAQ</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All FAQs</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="faqsTable">
            <thead><tr><th>#</th><th>Question</th><th>Category</th><th>Order</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,10) as $i)
                <tr>
                    <td>{{ $i }}</td>
                    <td class="fw-medium">Bagaimana cara membeli produk? {{ $i }}</td>
                    <td>{{ ['Umum','Produk','Pembayaran','Pengiriman','Garansi'][$i % 5] }}</td>
                    <td>{{ $i }}</td>
                    <td><span class="badge-status bg-{{ $i % 4 == 0 ? 'pending' : 'completed' }}">{{ $i % 4 == 0 ? 'Draft' : 'Published' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addFaqModal', 'title' => 'Tambah FAQ Baru', 'size' => 'md'])
<form>
    <div class="mb-3"><label class="form-label">Pertanyaan <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Jawaban <span class="text-danger">*</span></label><textarea class="form-control" rows="3" required></textarea></div>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Kategori</label><select class="form-select"><option>Umum</option><option>Produk</option><option>Pembayaran</option><option>Pengiriman</option><option>Garansi</option></select></div>
        <div class="col-md-3"><label class="form-label">Urutan</label><input type="number" class="form-control" value="1"></div>
        <div class="col-md-3"><label class="form-label">Status</label><select class="form-select"><option>Published</option><option>Draft</option></select></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Simpan</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#faqsTable').DataTable({ordering:true,pageLength:10,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'}});});</script>
@endpush
