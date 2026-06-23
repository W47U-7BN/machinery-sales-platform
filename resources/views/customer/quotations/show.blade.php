@extends('customer.layouts.customer')
@section('title', 'Detail Penawaran #'.$quotation->quotation_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Penawaran #{{ $quotation->quotation_number }}</h4>
        <p class="text-muted mb-0">{{ $quotation->created_at->format('d F Y') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('customer.quotations.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
        <a href="#" class="btn btn-danger btn-sm rounded-pill"><i class="bi bi-file-pdf me-1"></i>Download PDF</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-box me-2 text-primary"></i>Item Penawaran</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="small px-3">Produk</th>
                                <th class="small">Qty</th>
                                <th class="small">Harga</th>
                                <th class="small text-end px-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quotation->items ?? [] as $item)
                            <tr>
                                <td class="px-3">
                                    <span class="fw-medium small">{{ $item->product_name }}</span>
                                    @if($item->description)<br><span class="text-muted small">{{ $item->description }}</span>@endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-end px-3 fw-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted small">Tidak ada item</td></tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold px-3">Total</td>
                                <td class="text-end px-3 fw-bold fs-5">Rp {{ number_format($quotation->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Informasi</h6>
            </div>
            <div class="card-body px-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted small">Status</td>
                        <td class="text-end">{!! $quotation->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Berlaku Sampai</td>
                        <td class="text-end small">{{ $quotation->valid_until->format('d/m/Y') }}</td>
                    </tr>
                    @if($quotation->notes)
                    <tr>
                        <td colspan="2" class="small text-muted pt-2">{{ $quotation->notes }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="d-grid gap-2">
            <a href="#" class="btn btn-primary rounded-pill"><i class="bi bi-check-lg me-1"></i>Setujui Penawaran</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-chat-dots me-1"></i>Diskusikan</a>
        </div>
    </div>
</div>
@endsection
