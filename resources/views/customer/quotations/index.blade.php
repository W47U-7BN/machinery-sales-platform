@extends('customer.layouts.customer')
@section('title', 'Riwayat Penawaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Riwayat Penawaran</h4>
        <p class="text-muted mb-0">Daftar permintaan penawaran harga</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Quotation #</th>
                        <th class="small">Tanggal</th>
                        <th class="small">Berlaku Sampai</th>
                        <th class="small">Total</th>
                        <th class="small">Status</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotations ?? [] as $quotation)
                    <tr>
                        <td class="px-3"><span class="fw-medium">#{{ $quotation->quotation_number }}</span></td>
                        <td class="small text-muted">{{ $quotation->created_at->format('d/m/Y') }}</td>
                        <td class="small text-muted">{{ $quotation->valid_until->format('d/m/Y') }}</td>
                        <td class="fw-medium">Rp {{ number_format($quotation->total, 0, ',', '.') }}</td>
                        <td>{!! $quotation->status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="{{ route('customer.quotations.show', $quotation->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-file-pdf"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-file-text fs-2 d-block mb-2"></i>
                            Belum ada penawaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($quotations ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">
        {{ $quotations->links() }}
    </div>
    @endif
</div>
@endsection
