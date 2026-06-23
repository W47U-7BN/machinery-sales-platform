@extends('layouts.admin')

@section('title', 'Lead Detail')
@section('page-title', 'Lead Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">CRM</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a></li>
<li class="breadcrumb-item active">Lead #{{ $id ?? 1 }}</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent me-2"><i class="bi bi-person-check me-1"></i> Convert to Customer</button>
<a href="{{ route('admin.leads.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header"><h6>Lead Information</h6></div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Nama Lengkap</label>
                        <p class="fw-semibold">Budi Santoso</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Perusahaan</label>
                        <p class="fw-semibold">PT Makmur Sejahtera</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Email</label>
                        <p class="fw-semibold">budi@makmur.com <a href="mailto:budi@makmur.com" class="ms-2 text-decoration-none"><i class="bi bi-envelope"></i></a></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">No. Telepon</label>
                        <p class="fw-semibold">0812-3456-7890 <a href="tel:081234567890" class="ms-2 text-decoration-none"><i class="bi bi-telephone"></i></a></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Source</label>
                        <p><span class="badge bg-light text-dark rounded-pill px-3 py-1">Website</span></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Status</label>
                        <p><span class="badge-status bg-sent">Contacted</span></p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Assigned To</label>
                        <p class="fw-semibold">Sales Team A</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small">Notes</label>
                        <p class="text-muted">Client interested in excavator EC220D for construction project in Kalimantan. Follow up needed next week.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Pipeline Stage</h6></div>
            <div class="card-body">
                <div class="pipeline-steps">
                    <div class="pipeline-step completed"><i class="bi bi-check-circle-fill step-icon"></i> New Lead</div>
                    <div class="pipeline-connector completed"></div>
                    <div class="pipeline-step active"><i class="bi bi-chat-dots-fill step-icon"></i> Contacted</div>
                    <div class="pipeline-connector"></div>
                    <div class="pipeline-step"><i class="bi bi-folder-check step-icon"></i> Qualified</div>
                    <div class="pipeline-connector"></div>
                    <div class="pipeline-step"><i class="bi bi-file-text step-icon"></i> Proposal</div>
                    <div class="pipeline-connector"></div>
                    <div class="pipeline-step"><i class="bi bi-handshake step-icon"></i> Negotiation</div>
                    <div class="pipeline-connector"></div>
                    <div class="pipeline-step"><i class="bi bi-trophy step-icon"></i> Won</div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Activity Timeline</h6></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-time">Today, 09:30</div>
                        <div class="timeline-title">Phone Call - Follow Up</div>
                        <div class="timeline-text">Called client to discuss product specifications. Client requested a site visit.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot success"></div>
                        <div class="timeline-time">Yesterday, 14:15</div>
                        <div class="timeline-title">Email Sent - Product Catalog</div>
                        <div class="timeline-text">Sent digital catalog and price list for construction machinery line.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot warning"></div>
                        <div class="timeline-time">20 Jun 2026, 10:00</div>
                        <div class="timeline-title">Meeting - Initial Discussion</div>
                        <div class="timeline-text">Virtual meeting via Zoom. Discussed project requirements and budget range.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-time">15 Jun 2026</div>
                        <div class="timeline-title">Lead Created</div>
                        <div class="timeline-text">Lead entered via website inquiry form.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header"><h6>Quick Actions</h6></div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-admin-primary"><i class="bi bi-envelope me-2"></i>Send Email</button>
                    <button class="btn btn-admin-outline"><i class="bi bi-telephone me-2"></i>Log Call</button>
                    <button class="btn btn-admin-outline"><i class="bi bi-calendar-event me-2"></i>Schedule Meeting</button>
                    <button class="btn btn-admin-outline"><i class="bi bi-file-text me-2"></i>Create Quotation</button>
                    <button class="btn btn-admin-accent"><i class="bi bi-person-check me-2"></i>Convert to Customer</button>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Lead Score</h6></div>
            <div class="card-body text-center">
                <div style="font-size:48px;font-weight:700;color:var(--admin-primary);">85</div>
                <div class="text-muted small">out of 100</div>
                <div class="progress-track mt-3"><div class="progress-bar bg-success" style="width:85%"></div></div>
                <div class="mt-3">
                    <span class="badge bg-light text-dark me-2"><i class="bi bi-geo-alt text-primary"></i> High match</span>
                    <span class="badge bg-light text-dark"><i class="bi bi-currency-dollar text-success"></i> Budget match</span>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header"><h6>Related Deals</h6></div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <div><small class="text-muted d-block">QUO-2026-0001</small><span>Excavator EC220D</span></div>
                        <span class="badge-status bg-sent">Sent</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                        <div><small class="text-muted d-block">QUO-2026-0003</small><span>Bulldozer D6R</span></div>
                        <span class="badge-status bg-draft">Draft</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
