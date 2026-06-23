<button {{ $attributes->merge(['type' => 'button', 'class' => 'saas-btn saas-btn-secondary']) }}>
    <span class="btn-text">{{ $slot }}</span>
</button>
