@extends('customer.layouts.customer')
@section('title', 'Tiket Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Tiket Service</h4>
        <p class="text-muted mb-0">Kelola permintaan service Anda</p>
    </div>
    <a href="{{ route('customer.service-tickets.create') }}" class="btn btn-primary rounded-pill">
        <i class="bi bi-plus-circle me-1"></i>Buat Tiket Baru
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small px-3">Tiket #</th>
                        <th class="small">Subjek</th>
                        <th class="small">Prioritas</th>
                        <th class="small">Status</th>
                        <th class="small">Tanggal</th>
                        <th class="small text-end px-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets ?? [] as $ticket)
                    <tr>
                        <td class="px-3"><span class="fw-medium">#{{ $ticket->ticket_number }}</span></td>
                        <td class="small">{{ Str::limit($ticket->subject, 40) }}</td>
                        <td>{!! $ticket->priority_badge !!}</td>
                        <td>{!! $ticket->status_badge !!}</td>
                        <td class="small text-muted">{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td class="text-end px-3">
                            <a href="{{ route('customer.service-tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-ticket fs-2 d-block mb-2"></i>
                            Belum ada tiket service
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($tickets ?? [], 'links'))
    <div class="card-footer bg-transparent border-0">{{ $tickets->links() }}</div>
    @endif
</div>
@endsection
