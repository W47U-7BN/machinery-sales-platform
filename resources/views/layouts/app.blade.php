<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Design System --}}
        <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
        <link rel="stylesheet" href="{{ asset('css/saas-loading.css') }}">

        {{-- Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased" style="font-family: var(--ds-font-family);">
        {{-- Preloader --}}
        <div id="saas-preloader">
            <div class="saas-preloader-logo">
                <div class="logo-ring"></div>
                <div class="logo-icon">M</div>
            </div>
            <div class="saas-preloader-bars">
                <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
                <div class="bar"></div><div class="bar"></div><div class="bar"></div><div class="bar"></div>
            </div>
            <div class="saas-preloader-text">Loading your workspace...</div>
            <div class="saas-preloader-progress">
                <div class="progress-fill"></div>
            </div>
        </div>

        {{-- Toast Container --}}
        <div class="saas-toast-container"></div>

        <div class="min-h-screen" style="background: var(--ds-surface-secondary);">
            @include('layouts.navigation')

            {{-- Page Heading --}}
            @isset($header)
                <header style="background: var(--ds-surface); border-bottom: 1px solid var(--ds-border);">
                    <div style="max-width: var(--ds-content-max-width); margin: 0 auto; padding: 16px 24px;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main style="max-width: var(--ds-content-max-width); margin: 0 auto; padding: 24px; width: 100%;">
                @if(session('success'))
                    <div class="saas-alert saas-alert-success alert-dismissible" role="alert">
                        <span class="alert-icon">✓</span>
                        <div class="alert-content">{{ session('success') }}</div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="saas-alert saas-alert-danger alert-dismissible" role="alert">
                        <span class="alert-icon">✕</span>
                        <div class="alert-content">{{ session('error') }}</div>
                        <button class="alert-close">✕</button>
                    </div>
                @endif

                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>
        </div>

        {{-- Design System JS --}}
        <script src="{{ asset('js/saas-design-system.js') }}"></script>
        <script src="{{ asset('js/saas-loading.js') }}"></script>
        @stack('scripts')
    </body>
</html>
