@extends('dealer.layouts.dealer')
@section('title', 'Pesanan Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Pesanan Saya</h4>
        <p class="text-muted mb-0">Daftar pesanan yang telah Anda buat</p>
    </div>
    <a href="{{ route('dealer.orders.create') }}" class="btn btn-success rounded-pill"><i class="bi bi-plus-circle me-1"></i>Buat Pesanan</a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Order #</th>
                        <th class="small">Tanggal</th>
                        <th class="small">Total</th>
                        <th class="small">Komisi</th>
                        <th class="small">Status</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders ?? [] as $order)
                    <tr>
                        <td class="px-3"><span class="fw-medium">#{{ $order->order_number }}</span></td>
                        <td class="small text-muted">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="fw-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="text-success">Rp {{ number_format($order->commission ?? 0, 0, ',', '.') }}</td>
                        <td>{!! $order->status_badge !!}</td>
                        <td class="text-end px-3">
                            <a href="{{ route('dealer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-cart fs-2 d-block mb-2"></i>
                            Belum ada pesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($orders ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
