<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased" style="font-family: var(--ds-font-family); background: var(--ds-surface-secondary);">
        <div style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 24px;">
            <div style="margin-bottom: 24px;">
                <a href="/" style="text-decoration: none;">
                    <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--ds-primary), #8b5cf6); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 8px;">
                        <span style="color: #fff; font-size: 22px; font-weight: 700;">M</span>
                    </div>
                </a>
            </div>

            <div style="width: 100%; max-width: 420px; background: var(--ds-surface); border-radius: var(--ds-radius-2xl); border: 1px solid var(--ds-border); box-shadow: var(--ds-shadow-lg); padding: 32px;">
                {{ $slot }}
            </div>
        </div>

        <script src="{{ asset('js/saas-design-system.js') }}"></script>
        @stack('scripts')
    </body>
</html>
