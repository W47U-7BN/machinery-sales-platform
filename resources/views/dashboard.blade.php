<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: linear-gradient(135deg, var(--ds-primary), #8b5cf6); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; font-weight: 600;">{{ substr(Auth::user()->name, 0, 1) }}</div>
            <div>
                <h2 style="font-size: 18px; font-weight: 700; color: var(--ds-text-primary); margin: 0;">{{ __('Dashboard') }}</h2>
                <p style="font-size: 13px; color: var(--ds-text-tertiary); margin: 2px 0 0;">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
        </div>
    </x-slot>

    <div style="max-width: var(--ds-content-max-width); margin: 0 auto;">
        {{-- Quick Stats --}}
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="saas-stat-card">
                    <div class="stat-icon" style="background: rgba(16,185,129,0.12); color: #10b981;"><i class="bi bi-currency-dollar"></i></div>
                    <div class="stat-value">Rp 0</div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="saas-stat-card">
                    <div class="stat-icon" style="background: rgba(59,130,246,0.12); color: #3b82f6;"><i class="bi bi-box-seam"></i></div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Active Orders</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="saas-stat-card">
                    <div class="stat-icon" style="background: rgba(139,92,246,0.12); color: #8b5cf6;"><i class="bi bi-file-text"></i></div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Quotations</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="saas-stat-card">
                    <div class="stat-icon" style="background: rgba(245,158,11,0.12); color: #f59e0b;"><i class="bi bi-ticket"></i></div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Service Tickets</div>
                </div>
            </div>
        </div>

        <div class="saas-card">
            <div class="card-body" style="text-align: center; padding: 48px 24px;">
                <div style="font-size: 48px; margin-bottom: 16px; opacity: 0.3;">🚀</div>
                <h3 style="font-size: 20px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 8px;">{{ __("You're logged in!") }}</h3>
                <p style="font-size: 14px; color: var(--ds-text-secondary); margin: 0 0 24px; max-width: 400px; margin-left: auto; margin-right: auto;">
                    Welcome to your dashboard. You can manage your orders, quotations, invoices, and more from here.
                </p>
                <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('customer.orders.index') }}" class="saas-btn saas-btn-primary">View Orders</a>
                    <a href="{{ route('customer.quotations.index') }}" class="saas-btn saas-btn-secondary">View Quotations</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
