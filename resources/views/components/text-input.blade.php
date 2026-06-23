@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'saas-form-control']) }}>
