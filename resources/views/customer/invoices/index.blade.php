@extends('customer.layouts.customer')
@section('title', 'Invoice')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Invoice</h4>
        <p class="text-muted mb-0">Daftar tagihan Anda</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Invoice #</th>
                        <th class="small">Tanggal</th>
                        <th class="small">Jatuh Tempo</th>
                        <th class="small">Total</th>
                        <th class="small">Status Bayar</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices ?? [] as $invoice)
                    <tr>
                        <td class="px-3"><span class="fw-medium">#{{ $invoice->invoice_number }}</span></td>
                        <td class="small text-muted">{{ $invoice->created_at->format('d/m/Y') }}</td>
                        <td class="small text-muted">{{ $invoice->due_date->format('d/m/Y') }}</td>
                        <td class="fw-medium">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                        <td>{!! $invoice->payment_status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-pdf"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-2 d-block mb-2"></i>
                            Belum ada invoice
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($invoices ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $invoices->links() }}</div>
    @endif
</div>
@endsection
