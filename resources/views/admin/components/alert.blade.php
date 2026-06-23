<div class="saas-alert saas-alert-{{ $type ?? 'info' }} alert-dismissible" role="alert">
    @isset($icon)
    <span class="alert-icon"><i class="bi bi-{{ $icon }}"></i></span>
    @else
    <span class="alert-icon">
        @switch($type ?? 'info')
            @case('success')✓ @break
            @case('danger')✕ @break
            @case('warning')⚠ @break
            @defaultℹ
        @endswitch
    </span>
    @endisset
    <div class="alert-content">
        {{ $slot }}
    </div>
    <button class="alert-close">✕</button>
</div>
