@extends('layouts.admin')

@section('title', 'Service Ticket Detail')
@section('page-title', 'Service Ticket Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.service-tickets.index') }}">Layanan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.service-tickets.index') }}">Service Tickets</a></li>
<li class="breadcrumb-item active">SRV-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addSparepartModal"><i class="bi bi-plus me-1"></i> Add Sparepart</button>
    <button class="btn btn-admin-accent"><i class="bi bi-check-circle me-1"></i> Resolve Ticket</button>
    <a href="{{ route('admin.service-tickets.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Ticket Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3"><label class="text-muted small">Ticket#</label><p class="fw-semibold">SRV-0001</p></div>
                    <div class="col-md-3"><label class="text-muted small">Customer</label><p class="fw-semibold">PT Maju Jaya Abadi</p></div>
                    <div class="col-md-3"><label class="text-muted small">Product</label><p class="fw-semibold">Excavator EC220D</p></div>
                    <div class="col-md-3"><label class="text-muted small">Date</label><p class="fw-semibold">20 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Priority</label><p><span class="priority-badge bg-high">High</span></p></div>
                    <div class="col-md-3"><label class="text-muted small">Status</label><p><span class="badge-status bg-in-progress">In Progress</span></p></div>
                    <div class="col-md-3"><label class="text-muted small">Assigned To</label><p class="fw-semibold">Tech A</p></div>
                    <div class="col-md-3"><label class="text-muted small">Service Type</label><p class="fw-semibold">Repair</p></div>
                    <div class="col-12"><label class="text-muted small">Subject</label><p class="fw-semibold fs-6">Engine overheating issue on Excavator EC220D</p></div>
                    <div class="col-12"><label class="text-muted small">Description</label><p class="text-muted">Customer reports engine overheating after 4 hours of continuous operation. Coolant level normal, suspected issue with radiator fan clutch.</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Spareparts Used</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Part #</th><th>Name</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead>
                    <tbody>
                        <tr><td>SP-001</td><td>Radiator Fan Clutch</td><td>1</td><td>Rp 2.500.000</td><td class="fw-semibold">Rp 2.500.000</td></tr>
                        <tr><td>SP-002</td><td>Coolant Fluid 5L</td><td>2</td><td>Rp 150.000</td><td class="fw-semibold">Rp 300.000</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Activity Timeline</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">Today, 14:30</div><div class="timeline-title">Sparepart Added</div><div class="timeline-text">Radiator fan clutch and coolant added to ticket</div></div>
                    <div class="timeline-item"><div class="timeline-dot warning"></div><div class="timeline-time">Today, 10:00</div><div class="timeline-title">Diagnosis in Progress</div><div class="timeline-text">Technician on site, inspecting radiator fan assembly</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">Yesterday, 16:00</div><div class="timeline-title">Ticket Assigned</div><div class="timeline-text">Assigned to Tech A - Priority: High</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">20 Jun 2026, 09:15</div><div class="timeline-title">Ticket Created</div><div class="timeline-text">Customer reported engine overheating issue</div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Status Update</h6></div>
            <div class="card-body">
                <select class="form-select mb-3"><option>Open</option><option selected>In Progress</option><option>Resolved</option><option>Closed</option></select>
                <textarea class="form-control mb-3" rows="3" placeholder="Update notes...">Replacing radiator fan clutch. Testing in progress.</textarea>
                <button class="btn btn-admin-primary w-100">Update Status</button>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Resolution</h6></div>
            <div class="card-body">
                <textarea class="form-control mb-3" rows="3" placeholder="Resolution notes..."></textarea>
                <div class="mb-3"><label class="form-label">Resolution Time</label><input type="text" class="form-control" placeholder="e.g. 2 hours"></div>
                <button class="btn btn-admin-accent w-100">Mark as Resolved</button>
            </div>
        </div>
    </div>
</div>

@include('admin.components.modal', ['id' => 'addSparepartModal', 'title' => 'Add Sparepart'])
<form>
    <div class="row g-3">
        <div class="col-12"><label class="form-label">Sparepart <span class="text-danger">*</span></label><select class="form-select"><option>Select part</option><option>Radiator Fan Clutch</option><option>Coolant Fluid 5L</option><option>Hydraulic Filter</option></select></div>
        <div class="col-6"><label class="form-label">Quantity</label><input type="number" class="form-control" value="1"></div>
        <div class="col-6"><label class="form-label">Price/Unit</label><input type="text" class="form-control" readonly value="Rp 2.500.000"></div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-admin-primary">Add</button></div>
</form>
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent
@endsection
