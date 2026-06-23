@props(['items' => []])
<nav style="display:flex;align-items:center;gap:8px;font-size:14px;color:rgba(255,255,255,0.5);" aria-label="Breadcrumb">
    <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.5);transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color=''">
        <i class="fas fa-home"></i>
    </a>
    @foreach($items as $item)
        <i class="fas fa-chevron-right" style="font-size:10px;color:rgba(255,255,255,0.2);"></i>
        @if(isset($item['url']))
            <a href="{{ $item['url'] }}" style="color:rgba(255,255,255,0.5);transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color=''">{{ $item['label'] }}</a>
        @else
            <span style="color:var(--lp-secondary-light);font-weight:500;">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
