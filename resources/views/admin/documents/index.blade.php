@extends('layouts.admin')

@section('title', 'Documents')
@section('page-title', 'Document Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.documents.index') }}">System</a></li>
<li class="breadcrumb-item active">Documents</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent"><i class="bi bi-upload me-1"></i> Upload Document</button>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Categories</option><option>Contracts</option><option>Invoices</option><option>Reports</option><option>Manuals</option></select></div>
        <div style="min-width:200px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search document..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Documents</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="documentsTable">
            <thead><tr><th>Name</th><th>Category</th><th>File Type</th><th>Size</th><th>Uploaded By</th><th>Date</th><th>Downloads</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,15) as $i)
                <tr>
                    <td class="fw-medium"><i class="bi bi-file-earmark-text me-2 text-primary"></i> Document {{ $i }}.{{ ['pdf','docx','xlsx','pptx'][$i % 4] }}</td>
                    <td>{{ ['Contracts','Invoices','Reports','Manuals'][$i % 4] }}</td>
                    <td><span class="badge bg-light text-dark">{{ ['PDF','DOCX','XLSX','PPTX'][$i % 4] }}</span></td>
                    <td>{{ rand(100,5000) }} KB</td>
                    <td>User {{ chr(64+($i%5+1)) }}</td>
                    <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</td>
                    <td>{{ rand(0,100) }}</td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button><button class="btn btn-sm btn-outline-primary"><i class="bi bi-download"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 89 documents</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">6</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#documentsTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[7]}]});});</script>
@endpush
