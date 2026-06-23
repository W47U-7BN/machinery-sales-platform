@extends('customer.layouts.customer')
@section('title', 'Tiket #'.$ticket->ticket_number)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Tiket #{{ $ticket->ticket_number }}</h4>
        <p class="text-muted mb-0">{{ $ticket->subject }}</p>
    </div>
    <a href="{{ route('customer.service-tickets.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-chat-dots me-2 text-primary"></i>Percakapan</h6>
            </div>
            <div class="card-body px-3">
                @forelse($ticket->messages ?? [] as $message)
                <div class="d-flex mb-3 {{ $message->is_admin ? '' : 'flex-row-reverse' }}">
                    <div class="me-2 {{ $message->is_admin ? '' : 'ms-2' }}">
                        <div class="rounded-circle bg-{{ $message->is_admin ? 'primary' : 'secondary' }} d-flex align-items-center justify-content-center text-white" style="width: 36px; height: 36px; font-size: 14px;">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="bg-{{ $message->is_admin ? 'light' : 'primary bg-opacity-10' }} rounded-3 px-3 py-2" style="max-width: 75%;">
                        <p class="mb-1 small">{{ $message->message }}</p>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted small text-center py-4">Belum ada pesan</p>
                @endforelse
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body px-3">
                <form method="POST" action="{{ route('customer.service-tickets.reply', $ticket->id) }}">
                    @csrf
                    <div class="input-group">
                        <textarea name="message" rows="2" class="form-control" placeholder="Tulis balasan..." required></textarea>
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-3">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Tiket</h6>
            </div>
            <div class="card-body px-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted small">Status</td>
                        <td class="text-end">{!! $ticket->status_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Prioritas</td>
                        <td class="text-end">{!! $ticket->priority_badge !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Kategori</td>
                        <td class="text-end small">{{ $ticket->category ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Dibuat</td>
                        <td class="text-end small">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small">Terakhir Update</td>
                        <td class="text-end small">{{ $ticket->updated_at->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($ticket->attachments->count() > 0)
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-3 px-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-paperclip me-2 text-primary"></i>Lampiran</h6>
            </div>
            <div class="card-body px-3">
                @foreach($ticket->attachments as $attachment)
                <a href="{{ Storage::url($attachment->path) }}" class="d-block small mb-2 text-decoration-none" target="_blank">
                    <i class="bi bi-file-earmark me-1"></i>{{ $attachment->original_name }}
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
