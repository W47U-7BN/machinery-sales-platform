@extends('customer.layouts.customer')
@section('title', 'Chat dengan Admin')

@section('styles')
<style>
    .chat-container { height: calc(100vh - 200px); display: flex; flex-direction: column; }
    .chat-messages { flex: 1; overflow-y: auto; padding: 1rem; }
    .chat-message { max-width: 75%; margin-bottom: 1rem; }
    .chat-message.sent { margin-left: auto; }
    .chat-message .bubble { padding: 0.75rem 1rem; border-radius: 1rem; }
    .chat-message.sent .bubble { background-color: #0d6efd; color: white; border-bottom-right-radius: 0.25rem; }
    .chat-message.received .bubble { background-color: #f0f0f0; border-bottom-left-radius: 0.25rem; }
    .chat-input { border-top: 1px solid #dee2e6; padding: 1rem; background: white; }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Chat dengan Admin</h4>
        <p class="text-muted mb-0">Tanya jawab dengan tim kami</p>
    </div>
    <span class="badge bg-success rounded-pill"><i class="bi bi-circle-fill me-1 small"></i>Online</span>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0 chat-container">
        <div class="chat-messages" id="chatMessages">
            @forelse($messages ?? [] as $msg)
            <div class="chat-message {{ $msg->is_admin ? 'received' : 'sent' }}">
                <div class="bubble">
                    <p class="mb-0 small">{{ $msg->message }}</p>
                </div>
                <small class="text-muted px-1 {{ $msg->is_admin ? '' : 'text-end d-block' }}">{{ $msg->created_at->diffForHumans() }}</small>
            </div>
            @empty
            <div class="text-center text-muted py-5">
                <i class="bi bi-chat-dots fs-1 d-block mb-2"></i>
                <p class="small mb-0">Mulai percakapan dengan admin</p>
            </div>
            @endforelse
        </div>
        <div class="chat-input">
            <form method="POST" action="{{ route('customer.chat.send') }}" class="d-flex gap-2">
                @csrf
                <input type="text" name="message" class="form-control rounded-pill" placeholder="Ketik pesan..." required autocomplete="off">
                <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="bi bi-send"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var chatContainer = document.getElementById('chatMessages');
    if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;
</script>
@endsection
