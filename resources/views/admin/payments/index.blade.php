@extends('layouts.admin')

@section('title', 'Payments')
@section('page-title', 'Payments Management')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Penjualan</a></li>
<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')
<div class="filter-bar">
    <div class="d-flex align-items-center gap-2 flex-wrap w-100">
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Methods</option><option>Bank Transfer</option><option>Cash</option><option>Check</option><option>Credit Card</option></select></div>
        <div style="min-width:150px;flex:1;"><select class="form-select form-select-sm"><option>All Statuses</option><option>Verified</option><option>Pending</option><option>Failed</option></select></div>
        <div style="min-width:200px;flex:1;"><input type="text" class="form-control form-control-sm" placeholder="Search..."></div>
        <button class="btn btn-sm btn-admin-primary"><i class="bi bi-funnel"></i></button>
    </div>
</div>

<div class="admin-card">
    <div class="card-header"><h6>All Payments</h6></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table data-table mb-0" id="paymentsTable">
                <thead><tr><th>#Payment</th><th>Invoice</th><th>Customer</th><th>Date</th><th>Method</th><th>Amount</th><th>Reference</th><th>Status</th><th style="width:80px;">Actions</th></tr></thead>
                <tbody>
                    @foreach(range(1,15) as $i)
                    <tr>
                        <td class="fw-medium">PAY-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                        <td><a href="{{ route('admin.invoices.show', $i) }}" class="text-decoration-none">INV-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                        <td>PT Customer {{ $i }}</td>
                        <td class="text-muted">{{ date('d/m/Y', strtotime('-'.$i.' days')) }}</td>
                        <td>{{ ['Bank Transfer','Cash','Check','Credit Card'][$i % 4] }}</td>
                        <td>Rp {{ number_format(rand(1000000,100000000),0,',','.') }}</td>
                        <td class="text-muted">TRF-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</td>
                        <td><span class="badge-status bg-{{ $i % 5 == 0 ? 'pending' : ($i % 7 == 0 ? 'rejected' : 'completed') }}">{{ $i % 5 == 0 ? 'Pending' : ($i % 7 == 0 ? 'Failed' : 'Verified') }}</span></td>
                        <td><div class="action-btns"><a href="#" class="btn btn-sm btn-outline-info"><i class="bi bi-eye"></i></a></div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between align-items-center mt-3"><div class="text-muted small">Showing 1 to 15 of 892 entries</div><nav><ul class="pagination pagination-sm mb-0"><li class="page-item disabled"><a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a></li><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li><li class="page-item"><a class="page-link" href="#">...</a></li><li class="page-item"><a class="page-link" href="#">60</a></li><li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li></ul></nav></div>
@endsection

@push('scripts')
<script>$(document).ready(function(){$('#paymentsTable').DataTable({ordering:true,searching:true,pageLength:25,lengthMenu:[[10,25,50,100,-1],[10,25,50,100,'All']],language:{url:'//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'},columnDefs:[{orderable:false,targets:[8]}]});});</script>
@endpush
