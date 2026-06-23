@props(['href' => '#', 'icon' => ''])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors']) }}>
    @if($icon)
        <i class="fas fa-{{ $icon }} w-5 text-center text-gray-400"></i>
    @endif
    <span>{{ $slot }}</span>
</a>
