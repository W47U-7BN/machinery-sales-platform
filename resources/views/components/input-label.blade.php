@props(['value'])

<label {{ $attributes->merge(['class' => 'saas-form-label']) }}>
    {{ $value ?? $slot }}
</label>
