<div class="saas-stat-card">
    <div class="stat-icon" style="background: {{ $iconBg ?? 'rgba(37,99,235,0.1)' }}; color: {{ $iconColor ?? 'var(--ds-primary)' }};">
        <i class="bi bi-{{ $icon }}"></i>
    </div>
    <div class="stat-value">
        <span data-count-up="{{ preg_replace('/[^0-9.]/', '', $value) }}" data-count-prefix="{{ preg_match('/^Rp/', $value) ? 'Rp ' : '' }}" data-count-suffix="">
            {{ $value }}
        </span>
    </div>
    <div class="stat-label">{{ $label }}</div>
    @if(isset($change))
    <div class="stat-change {{ $change >= 0 ? 'up' : 'down' }}">
        <i class="bi bi-{{ $change >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
        {{ number_format(abs($change), 1) }}% from last month
    </div>
    @endif
</div>
