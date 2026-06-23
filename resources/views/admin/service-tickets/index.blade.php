@extends('layouts.admin')

@section('title', 'Service Tickets')
@section('page-title', 'Service Tickets Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.service-tickets.index') }}">Layanan</a></li>
<li class="breadcrumb-item active">Service Tickets</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addTicketModal"><i class="bi bi-plus-lg me-1"></i> New Ticket</button>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:140px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>Open</option><option>In Progress</option><option>Resolved</option><option>Closed</option></select></div>
        <div style="min-width:140px;flex:1;"><select class="form-select form-select-sm"><option>All Priorities</option><option>Low</option><option>Medium</option><option>High</option><option>Critical</option></select></div>
        <div style="min-width:180px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search ticket..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Service Tickets</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="ticketsTable">
                <thead><tr><th>Ticket#</th><th>Customer</th><th>Product</th><th>Subject</th><th>Priority</th><th>Status</th><th>Assigned To</th><th>Created</th><th style="width:100px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td class="fw-medium"><a href="{{ route('admin.service-tickets.show', $i) }}" class="text-decoration-none">SRV-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                        <td>Customer {{ $i }}</td>
                        <td>{{ ['Excavator EC220D','Bulldozer D6R','Crane RT100','Generator 2000W'][$i % 4] }}</td>
                        <td>Service request {{ $i }}</td>
                        <td><span class="priority-badge bg-{{ ['low','medium','high','critical'][$i % 4] }}">{{ ['Low','Medium','High','Critical'][$i % 4] }}</span></td>
                        <td><span class="badge-status bg-{{ ['pending','in-progress','completed','cancelled','processing'][$i % 5] }}">{{ ['Open','In Progress','Resolved','Closed','Processing'][$i % 5] }}</span></td>
                        <td>Tech {{ chr(65+($i%5)) }}</td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</td>
                        <td><div class="action-btns"><a href="{{ route('admin.service-tickets.show', $i) }}" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a><a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 156 tickets</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">11</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>

@include('admin.components.modal', ['id' => 'addTicketModal', 'title' => 'Buat Service Ticket Baru', 'size' => 'lg'])
<form>
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Customer <span class="text-danger">*</span></label><select class="form-select"><option>Select customer</option><option>PT Maju Jaya</option></select></div>
        <div class="col-md-6"><label class="form-label">Product <span class="text-danger">*</span></label><select class="form-select"><option>Select product</option><option>Excavator EC220D</option></select></div>
        <div class="col-12"><label class="form-label">Subject <span class="text-danger">*</span></label><input type="text" class="form-control" required></div>
        <div class="col-md-4"><label class="form-label">Priority</label><select class="form-select"><option>Low</option><option selected>Medium</option><option>High</option><option>Critical</option></select></div>
        <div class="col-md-4"><label class="form-label">Assigned To</label><select class="form-select"><option>Auto assign</option><option>Tech A</option><option>Tech B</option></select></div>
        <div class="col-md-4"><label class="form-label">Service Type</label><select class="form-select"><option>Repair</option><option>Maintenance</option><option>Installation</option><option>Consultation</option></select></div>
        <div class="col-12"><label class="form-label">Description <span class="text-danger">*</span></label><textarea class="form-control" rows="3" required></textarea></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Create Ticket</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#ticketsTable').DataTable({ordering:true,searching:true,pageLength:25,language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
