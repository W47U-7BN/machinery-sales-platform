@extends('layouts.admin')

@section('title', 'Newsletter')
@section('page-title', 'Newsletter Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.newsletters.index') }}">Marketing</a></li>
<li class="breadcrumb-item active">Newsletter</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent"><i class="bi bi-plus-lg me-1"></i> New Newsletter</button>
@endsection

@section('content')
<div class="admin-card">
    <div class="card-header"><h6>All Newsletters</h6></div>
    <div class="card-body p-0">
        <table class="table data-table mb-0" id="newsletterTable">
            <thead><tr><th>Subject</th><th>Sent Date</th><th>Recipients</th><th>Open Rate</th><th>Click Rate</th><th>Status</th><th style="width:80px;">Actions</th></tr></thead>
            <tbody>
                @foreach(range(1,10) as $i)
                <tr>
                    <td class="fw-medium">Newsletter Edition #{{ $i }} - Product Update</td>
                    <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i*7.' days')) }}</td>
                    <td>{{ number_format(rand(1000,5000),0,',','.') }}</td>
                    <td>{{ rand(20,45) }}%</td>
                    <td>{{ rand(3,15) }}%</td>
                    <td><span class="badge-status bg-{{ $i % 3 == 0 ? 'draft' : 'completed' }}">{{ $i % 3 == 0 ? 'Draft' : 'Sent' }}</span></td>
                    <td><div class="action-btns"><button class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></button><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 10 of 24 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#newsletterTable').DataTable({ordering:true,pageLength:10,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'}});});</script>
@endpush
