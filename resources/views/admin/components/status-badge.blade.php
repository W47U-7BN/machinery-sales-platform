@php
$badgeMap = [
    'draft' => 'saas-badge-gray',
    'sent' => 'saas-badge-primary',
    'approved' => 'saas-badge-success',
    'rejected' => 'saas-badge-danger',
    'expired' => 'saas-badge-warning',
    'pending' => 'saas-badge-warning',
    'processing' => 'saas-badge-primary',
    'completed' => 'saas-badge-success',
    'cancelled' => 'saas-badge-danger',
    'in-progress' => 'saas-badge-primary',
    'on-hold' => 'saas-badge-warning',
    'in-stock' => 'saas-badge-success',
    'low-stock' => 'saas-badge-warning',
    'out-of-stock' => 'saas-badge-danger',
];
$badgeClass = $badgeMap[$type ?? 'draft'] ?? 'saas-badge-gray';
@endphp
<span class="saas-badge {{ $badgeClass }}">{{ $slot }}</span>
