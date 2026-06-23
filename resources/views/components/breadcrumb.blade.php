@props(['items' => []])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0" style="background:transparent;padding:0;font-size:13px;">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}" style="color:var(--ds-text-secondary);text-decoration:none;">
                <i class="bi bi-house-door me-1"></i>Beranda
            </a>
        </li>
        @foreach($items as $item)
        @if($loop->last)
        <li class="breadcrumb-item active" aria-current="page" style="color:var(--ds-text-primary);font-weight:500;">{{ $item['label'] }}</li>
        @else
        <li class="breadcrumb-item">
            <a href="{{ $item['url'] ?? '#' }}" style="color:var(--ds-text-secondary);text-decoration:none;">{{ $item['label'] }}</a>
        </li>
        @endif
        @endforeach
    </ol>
</nav>
