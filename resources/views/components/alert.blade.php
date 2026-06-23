@props(['type' => 'info', 'dismissible' => true, 'message' => ''])

@php
$typeMap = [
    'success' => 'saas-alert-success',
    'error' => 'saas-alert-danger',
    'warning' => 'saas-alert-warning',
    'info' => 'saas-alert-info',
    'danger' => 'saas-alert-danger',
];
$icons = [
    'success' => '✓',
    'error' => '✕',
    'warning' => '⚠',
    'info' => 'ℹ',
    'danger' => '✕',
];
$class = $typeMap[$type] ?? 'saas-alert-info';
$icon = $icons[$type] ?? 'ℹ';
@endphp

<div class="saas-alert {{ $class }} {{ $dismissible ? 'alert-dismissible' : '' }}" role="alert">
    <span class="alert-icon">{{ $icon }}</span>
    <div class="alert-content">{{ $message ?? $slot }}</div>
    @if($dismissible)
    <button class="alert-close">✕</button>
    @endif
</div>
