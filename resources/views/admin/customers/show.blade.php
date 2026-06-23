@extends('layouts.admin')

@section('title', 'Customer Detail')
@section('page-title', 'Customer Detail')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">CRM</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
<li class="breadcrumb-item active">CUS-0001</li>
@endsection

@section('page-actions')
<div class="d-flex gap-2">
    <button class="btn btn-admin-accent"><i class="bi bi-file-text me-1"></i> New Quotation</button>
    <button class="btn btn-admin-primary"><i class="bi bi-cart me-1"></i> New Order</button>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-admin-light"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
@endsection

@section('content')
<div class="admin-card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center gap-4 flex-wrap">
            <div style="width:72px;height:72px;background:var(--admin-primary);border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;font-weight:700;">PT</div>
            <div>
                <h5 class="fw-bold mb-1">PT Maju Jaya Abadi</h5>
                <p class="text-muted mb-1">CUS-0001 | Customer since 15 Jan 2024</p>
                <div class="d-flex gap-3 flex-wrap">
                    <span><i class="bi bi-geo-alt text-primary me-1"></i> Jakarta Selatan</span>
                    <span><i class="bi bi-envelope text-primary me-1"></i> info@majujaya.com</span>
                    <span><i class="bi bi-telephone text-primary me-1"></i> 021-1234-5678</span>
                    <span><span class="badge-status bg-completed">Active</span></span>
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-tabs tab-nav-custom" id="customerTabs" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info">Info</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#contacts">Contacts</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">Orders</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#quotations">Quotations</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#invoices">Invoices</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#service">Service Tickets</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#projects">Projects</button></li>
</ul>

<div class="tab-content mt-4">
    <div class="tab-pane fade show active" id="info">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="admin-card">
                    <div class="card-header"><h6>Company Information</h6></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6"><label class="text-muted small">Company Name</label><p class="fw-medium">PT Maju Jaya Abadi</p></div>
                            <div class="col-6"><label class="text-muted small">Tax ID (NPWP)</label><p class="fw-medium">01.234.567.8-999.000</p></div>
                            <div class="col-6"><label class="text-muted small">Phone</label><p class="fw-medium">021-1234-5678</p></div>
                            <div class="col-6"><label class="text-muted small">Email</label><p class="fw-medium">info@majujaya.com</p></div>
                            <div class="col-6"><label class="text-muted small">Website</label><p class="fw-medium">www.majujaya.com</p></div>
                            <div class="col-6"><label class="text-muted small">Industry</label><p class="fw-medium">Construction</p></div>
                            <div class="col-12"><label class="text-muted small">Address</label><p class="fw-medium">Jl. Gatot Subroto Kav. 56, Jakarta Selatan 12950</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="admin-card">
                    <div class="card-header"><h6>Account Summary</h6></div>
                    <div class="card-body">
                        <div class="row g-3 text-center">
                            <div class="col-4"><div class="fw-bold fs-4" style="color:var(--admin-primary);">47</div><div class="small text-muted">Total Orders</div></div>
                            <div class="col-4"><div class="fw-bold fs-4" style="color:var(--admin-accent);">Rp 2.3M</div><div class="small text-muted">Outstanding</div></div>
                            <div class="col-4"><div class="fw-bold fs-4" style="color:#2ecc71;">Rp 12.8M</div><div class="small text-muted">Total Paid</div></div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Last Order</span>
                            <span class="fw-medium">15 Jun 2026</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted small">Payment Terms</span>
                            <span class="fw-medium">Net 30</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted small">Credit Limit</span>
                            <span class="fw-medium">Rp 50.000.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="contacts">
        <div class="admin-card">
            <div class="card-header"><h6>Contact Persons</h6> <button class="btn btn-sm btn-admin-primary"><i class="bi bi-plus"></i> Add Contact</button></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Name</th><th>Position</th><th>Email</th><th>Phone</th><th>Primary</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,3) as $i)
                        <tr>
                            <td class="fw-medium">Contact {{ $i }}</td>
                            <td>{{ ['Director','Manager','Supervisor'][$i % 3] }}</td>
                            <td>contact{{ $i }}@majujaya.com</td>
                            <td>0812-0000-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                            <td>@if($i == 1)<span class="badge bg-primary rounded-pill px-2">Primary</span>@endif</td>
                            <td><div class="action-btns"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button><button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="orders">
        <div class="admin-card">
            <div class="card-header"><h6>Order History</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#Order</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,5) as $i)
                        <tr>
                            <td><a href="#" class="fw-medium text-decoration-none">ORD-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td class="text-muted">{{ date('d M Y', strtotime('-'.$i*7.' days')) }}</td>
                            <td>{{ rand(1,10) }}</td>
                            <td>Rp {{ number_format(rand(1000000,50000000),0,',','.') }}</td>
                            <td><span class="badge-status bg-{{ ['completed','processing','sent','pending','completed'][$i % 5] }}">{{ ['Completed','Processing','Sent','Pending','Completed'][$i % 5] }}</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="quotations">
        <div class="admin-card">
            <div class="card-header"><h6>Quotation History</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#Quote</th><th>Date</th><th>Valid Until</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,5) as $i)
                        <tr>
                            <td><a href="#" class="fw-medium text-decoration-none">QUO-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td class="text-muted">{{ date('d M Y', strtotime('-'.$i*5.' days')) }}</td>
                            <td class="text-muted">{{ date('d M Y', strtotime('+'.$i*10.' days')) }}</td>
                            <td>Rp {{ number_format(rand(1000000,50000000),0,',','.') }}</td>
                            <td><span class="badge-status bg-{{ ['draft','sent','approved','rejected','expired'][$i % 5] }}">{{ ['Draft','Sent','Approved','Rejected','Expired'][$i % 5] }}</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="invoices">
        <div class="admin-card">
            <div class="card-header"><h6>Invoice History</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>#Invoice</th><th>Date</th><th>Due Date</th><th>Amount</th><th>Paid</th><th>Balance</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,5) as $i)
                        <tr>
                            <td><a href="#" class="fw-medium text-decoration-none">INV-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td class="text-muted">{{ date('d M Y', strtotime('-'.$i*10.' days')) }}</td>
                            <td class="text-muted">{{ date('d M Y', strtotime('+'.(30-$i*5).' days')) }}</td>
                            <td>Rp {{ number_format(rand(5000000,50000000),0,',','.') }}</td>
                            <td>Rp {{ number_format(rand(0,50000000),0,',','.') }}</td>
                            <td>Rp {{ number_format(rand(0,10000000),0,',','.') }}</td>
                            <td><span class="badge-status bg-{{ ['completed','pending','completed','expired','sent'][$i % 5] }}">{{ ['Paid','Unpaid','Paid','Overdue','Partial'][$i % 5] }}</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="service">
        <div class="admin-card">
            <div class="card-header"><h6>Service Tickets</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Ticket#</th><th>Product</th><th>Subject</th><th>Priority</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,4) as $i)
                        <tr>
                            <td><a href="#" class="fw-medium text-decoration-none">SRV-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                            <td>Excavator EC220D</td>
                            <td>Routine maintenance {{ $i }}</td>
                            <td><span class="priority-badge bg-{{ ['low','medium','high','critical'][$i % 4] }}">{{ ['Low','Medium','High','Critical'][$i % 4] }}</span></td>
                            <td><span class="badge-status bg-{{ ['completed','in-progress','pending','processing'][$i % 4] }}">{{ ['Resolved','In Progress','Open','Processing'][$i % 4] }}</span></td>
                            <td class="text-muted">{{ date('d M Y', strtotime('-'.$i*3.' days')) }}</td>
                            <td><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="projects">
        <div class="admin-card">
            <div class="card-header"><h6>Projects</h6></div>
            <div class="card-body p-0">
                <table class="table data-table mb-0">
                    <thead><tr><th>Project</th><th>Start Date</th><th>End Date</th><th>Value</th><th>Progress</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach(range(1,3) as $i)
                        <tr>
                            <td class="fw-medium">Project Alpha {{ $i }}</td>
                            <td class="text-muted">{{ date('d M Y', strtotime('-'.$i*30.' days')) }}</td>
                            <td class="text-muted">{{ date('d M Y', strtotime('+'.(90-$i*20).' days')) }}</td>
                            <td>Rp {{ number_format(rand(50000000,500000000),0,',','.') }}</td>
                            <td><div class="d-flex align-items-center gap-2"><div class="progress-track flex-grow-1"><div class="progress-bar bg-success" style="width:{{ rand(20,100) }}%"></div></div><small>{{ rand(20,100) }}%</small></div></td>
                            <td><span class="badge-status bg-{{ ['in-progress','completed','processing'][$i % 3] }}">{{ ['In Progress','Completed','On Hold'][$i % 3] }}</span></td>
                            <td><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
