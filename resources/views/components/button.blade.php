@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => '',
    'href' => null,
    'icon' => null,
    'disabled' => false,
])

@php
$variantMap = [
    'primary' => 'saas-btn-primary',
    'secondary' => 'saas-btn-secondary',
    'danger' => 'saas-btn-danger',
    'success' => 'saas-btn-success',
    'warning' => 'saas-btn-warning',
    'ghost' => 'saas-btn-ghost',
];
$sizeMap = [
    'sm' => 'saas-btn-sm',
    'lg' => 'saas-btn-lg',
];
$btnClass = 'saas-btn ' . ($variantMap[$variant] ?? 'saas-btn-primary');
if ($size && isset($sizeMap[$size])) $btnClass .= ' ' . $sizeMap[$size];
if ($disabled) $btnClass .= ' disabled';
@endphp

@if($href)
<a href="{{ $href }}" class="{{ $btnClass }}" {{ $disabled ? 'aria-disabled="true" tabindex="-1"' : '' }}>
    @if($icon)<i class="bi bi-{{ $icon }}"></i>@endif
    <span class="btn-text">{{ $slot }}</span>
</a>
@else
<button type="{{ $type }}" class="{{ $btnClass }}" {{ $disabled ? 'disabled' : '' }}>
    @if($icon)<i class="bi bi-{{ $icon }}"></i>@endif
    <span class="btn-text">{{ $slot }}</span>
</button>
@endif
