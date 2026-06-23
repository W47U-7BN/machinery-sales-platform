@extends('layouts.admin')

@section('title', 'Project Detail')
@section('page-title', 'Project Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Layanan</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
<li class="breadcrumb-item active">Project Alpha 1</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-primary"><i class="bi bi-pencil me-1"></i> Edit</button>
    <button class="btn btn-admin-accent"><i class="bi bi-plus me-1"></i> Add Task</button>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Project Information</h6></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4"><label class="text-muted small">Project Name</label><p class="fw-semibold">Project Alpha 1</p></div>
                    <div class="col-md-4"><label class="text-muted small">Customer</label><p class="fw-semibold">PT Maju Jaya Abadi</p></div>
                    <div class="col-md-4"><label class="text-muted small">Status</label><p><span class="badge-status bg-in-progress">In Progress</span></p></div>
                    <div class="col-md-3"><label class="text-muted small">Start Date</label><p class="fw-semibold">01 Jun 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">End Date</label><p class="fw-semibold">30 Aug 2026</p></div>
                    <div class="col-md-3"><label class="text-muted small">Duration</label><p class="fw-semibold">90 days</p></div>
                    <div class="col-md-3"><label class="text-muted small">Value</label><p class="fw-semibold">Rp 250.000.000</p></div>
                    <div class="col-12"><label class="text-muted small">Description</label><p class="text-muted">Installation and configuration of conveyor system for new warehouse facility at PT Maju Jaya Abadi.</p></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Progress</h6></div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="flex-grow-1"><div class="progress-track" style="height:12px;"><div class="progress-bar bg-success" style="width:65%;height:12px;border-radius:6px;"></div></div></div>
                    <span class="fw-bold fs-5" style="color:var(--admin-primary);">65%</span>
                </div>
                <div class="row text-center g-3">
                    <div class="col-3"><div class="fw-bold fs-4">12</div><small class="text-muted">Total Tasks</small></div>
                    <div class="col-3"><div class="fw-bold fs-4 text-success">8</div><small class="text-muted">Completed</small></div>
                    <div class="col-3"><div class="fw-bold fs-4 text-primary">3</div><small class="text-muted">In Progress</small></div>
                    <div class="col-3"><div class="fw-bold fs-4 text-warning">1</div><small class="text-muted">Pending</small></div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Tasks</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Task</th><th>Assigned To</th><th>Due Date</th><th>Priority</th><th>Status</th><th style="width:60px;"></th></tr></thead>
                    <tbody>
                        @foreach(range(1,8) as $i)
                        <tr>
                            <td>Task {{ $i }} - {{ ['Site survey','Foundation prep','Equipment delivery','Installation','Wiring','Testing','Commissioning','Training'][$i-1] }}</td>
                            <td>Tech {{ chr(64+($i%4+1)) }}</td>
                            <td class="text-muted">{{ date('d/m/Y', strtotime('+'.$i*7.' days')) }}</td>
                            <td><span class="priority-badge bg-{{ ['low','medium','high','medium','low','critical','medium','low'][$i-1] }}">{{ ['Low','Medium','High','Medium','Low','Critical','Medium','Low'][$i-1] }}</span></td>
                            <td><span class="badge-status bg-{{ $i <= 4 ? 'completed' : ($i <= 6 ? 'in-progress' : 'pending') }}">{{ $i <= 4 ? 'Done' : ($i <= 6 ? 'In Progress' : 'Pending') }}</span></td>
                            <td><button class="btn btn-sm btn-outline-primary"><i class="bi bi-check"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Team</h6></div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @foreach(range(1,4) as $i)
                    <div class="list-group-item py-3 d-flex align-items-center gap-3">
                        <div style="width:36px;height:36px;background:var(--admin-primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:13px;">{{ chr(64+$i) }}</div>
                        <div><div class="fw-medium small">Team Member {{ chr(64+$i) }}</div><small class="text-muted">{{ ['Project Manager','Engineer','Technician','Coordinator'][$i-1] }}</small></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Timeline</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item"><div class="timeline-dot success"></div><div class="timeline-time">Today</div><div class="timeline-title">Equipment Testing</div></div>
                    <div class="timeline-item"><div class="timeline-dot success"></div><div class="timeline-time">15 Jun</div><div class="timeline-title">Installation Phase</div></div>
                    <div class="timeline-item"><div class="timeline-dot"></div><div class="timeline-time">01 Jun</div><div class="timeline-title">Project Started</div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
