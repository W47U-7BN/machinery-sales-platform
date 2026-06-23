<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - {{ config('app.name', 'ERP System') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/saas-design-system.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 24px;
            overflow: hidden;
        }
        .maint-container {
            text-align: center;
            max-width: 520px;
            width: 100%;
            position: relative;
        }
        .maint-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            animation: maint-pulse 2s ease-in-out infinite;
            position: relative;
        }
        .maint-icon::before {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(37,99,235,0.3), rgba(124,58,237,0.3));
            animation: maint-ring 2s ease-in-out infinite;
        }
        @keyframes maint-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.03); }
        }
        @keyframes maint-ring {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0; }
        }
        .maint-icon i { position: relative; z-index: 1; color: #fff; }
        .maint-title {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            margin: 0 0 8px;
            letter-spacing: -0.02em;
        }
        .maint-desc {
            font-size: 15px;
            color: rgba(255,255,255,0.6);
            line-height: 1.6;
            margin: 0 0 32px;
        }
        .maint-progress-wrap {
            background: rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .maint-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .maint-progress-header span {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        .maint-progress-header strong {
            color: #fff;
        }
        .maint-progress-track {
            height: 6px;
            background: rgba(255,255,255,0.1);
            border-radius: 3px;
            overflow: hidden;
        }
        .maint-progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #2563eb, #7c3aed);
            border-radius: 3px;
            animation: maint-progress 4s ease-in-out infinite;
        }
        @keyframes maint-progress {
            0% { width: 0%; }
            50% { width: 75%; }
            100% { width: 100%; }
        }
        .maint-info {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }
        .maint-info-item {
            text-align: center;
        }
        .maint-info-item .info-value {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
        }
        .maint-info-item .info-label {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
        }
        .maint-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .maint-actions .saas-btn {
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
        }
        .maint-actions .saas-btn:hover {
            background: rgba(255,255,255,0.1);
        }
        .maint-contact {
            margin-top: 32px;
            font-size: 13px;
            color: rgba(255,255,255,0.4);
        }
        .maint-contact a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }
        .maint-contact a:hover { color: #fff; }
        .maint-bg-shapes {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: -1;
        }
        .maint-bg-shapes .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.03;
        }
        .maint-bg-shapes .shape:nth-child(1) {
            width: 400px; height: 400px;
            background: #2563eb;
            top: -100px; right: -100px;
            animation: float 8s ease-in-out infinite;
        }
        .maint-bg-shapes .shape:nth-child(2) {
            width: 300px; height: 300px;
            background: #7c3aed;
            bottom: -50px; left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }
    </style>
</head>
<body>
    <div class="maint-bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="maint-container saas-fade-up">
        <div class="maint-icon"><i class="bi bi-gear-wide-connected"></i></div>
        <h1 class="maint-title">Under Maintenance</h1>
        <p class="maint-desc">We are upgrading our system to serve you better. This should only take a few minutes.</p>

        <div class="maint-progress-wrap">
            <div class="maint-progress-header">
                <span>Progress</span>
                <span><strong id="maint-percent">75%</strong> complete</span>
            </div>
            <div class="maint-progress-track">
                <div class="maint-progress-fill"></div>
            </div>
        </div>

        <div class="maint-info">
            <div class="maint-info-item">
                <div class="info-value">~30 min</div>
                <div class="info-label">Estimated Time</div>
            </div>
            <div class="maint-info-item">
                <div class="info-value">Database</div>
                <div class="info-label">Current Task</div>
            </div>
            <div class="maint-info-item">
                <div class="info-value">v2.0</div>
                <div class="info-label">New Version</div>
            </div>
        </div>

        <div class="maint-actions">
            <a href="javascript:location.reload()" class="saas-btn saas-btn-secondary">
                <i class="bi bi-arrow-clockwise"></i> Refresh
            </a>
        </div>

        <div class="maint-contact">
            Need help? Contact <a href="mailto:support@example.com">support@example.com</a>
        </div>
    </div>

    <script>
        const percentEl = document.getElementById('maint-percent');
        if (percentEl) {
            let pct = 0;
            setInterval(() => {
                pct = Math.min(pct + Math.random() * 8, 99);
                percentEl.textContent = Math.round(pct) + '%';
            }, 2000);
        }
    </script>
</body>
</html>
