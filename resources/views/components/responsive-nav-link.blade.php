@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 text-start text-base font-medium transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 text-start text-base font-medium transition duration-150 ease-in-out';
$style = ($active ?? false)
            ? 'color: var(--ds-primary); background: var(--ds-primary-50); border-left: 3px solid var(--ds-primary);'
            : 'color: var(--ds-text-secondary); border-left: 3px solid transparent;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
    {{ $slot }}
</a>
