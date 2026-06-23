@extends('layouts.admin')

@section('title', 'Articles')
@section('page-title', 'Articles Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Marketing</a></li>
<li class="breadcrumb-item active">Articles</li>
@endsection

@section('page-actions')
<a href="{{ route('admin.articles.create') }}" class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> New Article</a>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Articles</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="articlesTable">
            <thead><tr><th>Title</th><th>Category</th><th>Author</th><th>Published</th><th>Views</th><th>Status</th><th style="width:100px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,12) as $i)
                <tr>
                    <td class="fw-medium">{{ ['Tips Memilih Excavator','Perawatan Bulldozer','Inovasi Mesin 2026','Panduan Hidrolik','Keamanan Alat Berat','Efisiensi BBM','Mesin Pertanian Modern','Konstruksi Hijau','Industri 4.0','Teknologi CNC','Pompa Industri','Sistem Otomasi Pabrik'][$i-1] }}</td>
                    <td>{{ ['Tips','Maintenance','Teknologi','Panduan','Safety','Efisiensi','Agrikultur','Konstruksi','Industri','Manufaktur','Engineering','Otomasi'][$i-1] }}</td>
                    <td>Admin</td>
                    <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i*5.' days')) }}</td>
                    <td>{{ number_format(rand(100,5000),0,',','.') }}</td>
                    <td><span class="badge-status bg-{{ $i % 3 == 0 ? 'draft' : 'completed' }}">{{ $i % 3 == 0 ? 'Draft' : 'Published' }}</span></td>
                    <td><div class="action-btns"><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="{{ route('admin.articles.edit', $i) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a><a href="#" onclick="return confirmDelete('#','article')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 12 of 45 articles</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">4</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#articlesTable').DataTable({ordering:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[6]}]});});</script>
@endpush
