<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Error') - {{ config('app.name', 'ERP System') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--ds-surface-secondary);
            padding: 24px;
        }
        .error-container {
            text-align: center;
            max-width: 480px;
            width: 100%;
        }
        .error-code {
            font-size: 120px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, var(--ds-primary), #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -0.05em;
        }
        .error-icon {
            font-size: 64px;
            margin-bottom: 16px;
            display: block;
        }
        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--ds-text-primary);
            margin: 0 0 8px;
        }
        .error-message {
            font-size: 15px;
            color: var(--ds-text-secondary);
            line-height: 1.6;
            margin: 0 0 32px;
        }
        .error-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .error-actions .saas-btn {
            min-width: 120px;
        }
        .error-footer {
            margin-top: 48px;
            font-size: 12px;
            color: var(--ds-text-tertiary);
        }
        @media (max-width: 575px) {
            .error-code { font-size: 80px; }
            .error-title { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="error-container saas-fade-up">
        <span class="error-icon">@yield('icon', '🔍')</span>
        <div class="error-code">@yield('code', '404')</div>
        <h1 class="error-title">@yield('title', 'Page Not Found')</h1>
        <p class="error-message">@yield('message', 'The page you are looking for does not exist or has been moved.')</p>
        <div class="error-actions">
            <a href="javascript:history.back()" class="saas-btn saas-btn-secondary">
                <i class="bi bi-arrow-left"></i> Go Back
            </a>
            <a href="{{ url('/') }}" class="saas-btn saas-btn-primary">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="javascript:location.reload()" class="saas-btn saas-btn-ghost">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </a>
        </div>
        <div class="error-footer">
            &copy; {{ date('Y') }} {{ config('app.name', 'ERP System') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
