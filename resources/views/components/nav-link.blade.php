@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 rounded-md transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-2 text-sm font-medium leading-5 rounded-md transition duration-150 ease-in-out';
$style = ($active ?? false)
            ? 'color: var(--ds-primary); background: var(--ds-primary-50);'
            : 'color: var(--ds-text-secondary); background: transparent;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
    {{ $slot }}
</a>
