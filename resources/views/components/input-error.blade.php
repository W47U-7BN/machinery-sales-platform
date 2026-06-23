@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="saas-form-error">{{ $message }}</div>
    @endforeach
@endif
