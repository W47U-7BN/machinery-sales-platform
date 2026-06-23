@props(['title' => '', 'active' => false])

<div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <button class="px-4 py-2 text-sm font-medium rounded-lg transition-all flex items-center space-x-1 {{ $active ? 'text-primary bg-gray-50' : 'text-gray-700 hover:text-primary hover:bg-gray-50' }}">
        <span>{{ $title }}</span>
        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
    </button>
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 mt-1">
        {{ $slot }}
    </div>
</div>
