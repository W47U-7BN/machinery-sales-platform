@extends('layouts.admin')

@section('title', 'Leads')
@section('page-title', 'Leads Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">CRM</a></li>
<li class="breadcrumb-item active">Leads</li>
@endsection

@section('page-actions')
<button class="btn btn-admin-accent" data-bs-toggle="modal" data-bs-target="#addLeadModal">
    <i class="bi bi-plus-lg me-1"></i> Tambah Lead
</button>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;">
            <select class="form-select form-select-sm" id="filter-source">
                <option value="">All Sources</option>
                <option>Website</option>
                <option>Referral</option>
                <option>Social Media</option>
                <option>Email Campaign</option>
                <option>Event</option>
                <option>Phone</option>
                <option>Other</option>
            </select>
        </div>
        <div style="min-width:150px;flex:1;">
            <select class="form-select form-select-sm" id="filter-status">
                <option value="">All Statuses</option>
                <option>New</option>
                <option>Contacted</option>
                <option>Qualified</option>
                <option>Proposal</option>
                <option>Negotiation</option>
                <option>Won</option>
                <option>Lost</option>
            </select>
        </div>
        <div style="min-width:150px;flex:1;">
            <select class="form-select form-select-sm" id="filter-assigned">
                <option value="">All Assignees</option>
                <option>Admin User</option>
                <option>Sales Team A</option>
                <option>Sales Team B</option>
            </select>
        </div>
        <div style="min-width:180px;flex:1;">
            <input type="text" class="form-control form-control-sm" placeholder="Date range" id="filter-date">
        </div>
        <div class="d-flex gap-1">
            <button class="btn btn-sm btn-admin-primary" onclick="applyFilters()"><i class="bi bi-funnel"></i></button>
            <button class="btn btn-sm btn-admin-light" onclick="resetFilters()"><i class="bi bi-x"></i></button>
        </div>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h6>All Leads</h6>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-admin-light" onclick="exportTable()"><i class="bi bi-download me-1"></i> Export</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="leadsTable">
                <thead>
                    <tr>
                        <th style="width:30px;"><input type="checkbox" class="form-check-input" id="selectAll"></th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>Created</th>
                        <th style="width:100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td><input type="checkbox" class="form-check-input lead-checkbox" value="{{ $i }}"></td>
                        <td><a href="{{ route('admin.leads.show', $i) }}" class="text-decoration-none fw-medium">Budi Santoso {{ $i }}</a></td>
                        <td>PT Makmur Sejahtera {{ $i }}</td>
                        <td>budi{{ $i }}@email.com</td>
                        <td>0812-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}-{{ str_pad($i*2,4,'0',STR_PAD_LEFT) }}</td>
                        <td><span class="badge bg-light text-dark rounded-pill px-3 py-1 fs-12">{{ ['Website','Referral','Social Media','Email','Event','Phone'][$i % 6] }}</span></td>
                        <td><span class="badge-status bg-{{ ['draft','sent','approved','pending','processing','completed','rejected'][$i % 7] }}">{{ ['New','Contacted','Qualified','Proposal','Negotiation','Won','Lost'][$i % 7] }}</span></td>
                        <td>Sales {{ chr(64 + ($i % 4 + 1)) }}</td>
                        <td class="text-muted">{{ date('d M Y', strtotime('-'.$i.' days')) }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.leads.show', $i) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-primary" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="#" onclick="return confirmDelete('{{ route('admin.leads.index') }}/'+{{ $i }}, 'lead')" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.components.modal', [
    'id' => 'addLeadModal',
    'title' => 'Tambah Lead Baru',
    'size' => 'lg'
])
<form>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Perusahaan</label>
            <input type="text" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Source</label>
            <select class="form-select">
                <option>Website</option>
                <option>Referral</option>
                <option>Social Media</option>
                <option>Email Campaign</option>
                <option>Event</option>
                <option>Phone</option>
                <option>Other</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Assigned To</label>
            <select class="form-select">
                <option>Admin User</option>
                <option>Sales Team A</option>
                <option>Sales Team B</option>
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">Notes</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-admin-primary">Simpan Lead</button>
    </div>
</form>
{{-- Close modal --}}
<div class="modal-footer"><button type="button" class="btn btn-admin-light" data-bs-dismiss="modal">Close</button></div>
@endcomponent

<div class="d-flex justify-content-between align-items-center mt-3">
    <div class="text-muted small">Showing 1 to 15 of 348 entries</div>
    <nav><ul class="pagination pagination-sm mb-0">
        <li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">...</a></li>
        <li class="page-item"><a class="page-link" href="#">24</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
    </ul></nav>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#leadsTable').DataTable({
        ordering: true, searching: true, pageLength: 25,
        lengthMenu: [[10,25,50,100,-1],[10,25,50,100,'All']],
        language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: [0,9] }]
    });

    $('#selectAll').on('change', function() {
        $('.lead-checkbox').prop('checked', this.checked);
    });
    $('#filter-date').daterangepicker ? $('#filter-date').daterangepicker({ locale: { format: 'DD/MM/YYYY' } }) : null;
});

function applyFilters() {
    showToast('Filters applied', 'success');
}
function resetFilters() {
    document.querySelectorAll('.filter-bar select, .filter-bar input').forEach(el => el.value = '');
    showToast('Filters reset', 'info');
}
</script>
@endpush
