<button {{ $attributes->merge(['type' => 'submit', 'class' => 'saas-btn saas-btn-primary']) }}>
    <span class="btn-text">{{ $slot }}</span>
</button>
