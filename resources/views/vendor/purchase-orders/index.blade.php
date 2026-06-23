@extends('vendor.layouts.vendor')
@section('title', 'Purchase Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Purchase Orders</h4>
        <p class="text-muted mb-0">Daftar purchase order dari perusahaan</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">PO #</th>
                        <th class="small">Tanggal</th>
                        <th class="small">Item</th>
                        <th class="small">Total</th>
                        <th class="small">Status</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchaseOrders ?? [] as $po)
                    <tr>
                        <td class="px-3"><span class="fw-medium">#{{ $po->po_number }}</span></td>
                        <td class="small text-muted">{{ $po->created_at->format('d/m/Y') }}</td>
                        <td class="small">{{ $po->items_count ?? $po->items->count() }} item</td>
                        <td class="fw-medium">Rp {{ number_format($po->total, 0, ',', '.') }}</td>
                        <td>{!! $po->status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="{{ route('vendor.purchase-orders.show', $po->id) }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-text fs-2 d-block mb-2"></i>
                            Belum ada purchase order
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($purchaseOrders ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $purchaseOrders->links() }}</div>
    @endif
</div>
@endsection
