@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
{{-- Stat Cards --}}
<div class="row g-4 mb-4 saas-stagger">
    <div class="col-xl-3 col-md-6">
        @include('admin.components.stat-card', [
            'icon' => 'currency-dollar',
            'value' => '12800000',
            'label' => 'Total Revenue',
            'change' => 12.5,
            'iconBg' => 'rgba(16,185,129,0.12)',
            'iconColor' => '#10b981'
        ])
    </div>
    <div class="col-xl-3 col-md-6">
        @include('admin.components.stat-card', [
            'icon' => 'people',
            'value' => '348',
            'label' => 'Total Leads',
            'change' => 8.2,
            'iconBg' => 'rgba(59,130,246,0.12)',
            'iconColor' => '#3b82f6'
        ])
    </div>
    <div class="col-xl-3 col-md-6">
        @include('admin.components.stat-card', [
            'icon' => 'person-check',
            'value' => '1245',
            'label' => 'Active Customers',
            'change' => 5.7,
            'iconBg' => 'rgba(139,92,246,0.12)',
            'iconColor' => '#8b5cf6'
        ])
    </div>
    <div class="col-xl-3 col-md-6">
        @include('admin.components.stat-card', [
            'icon' => 'clock-history',
            'value' => '23',
            'label' => 'Pending Orders',
            'change' => -3.1,
            'iconBg' => 'rgba(245,158,11,0.12)',
            'iconColor' => '#f59e0b'
        ])
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-4 mb-4">
    <div class="col-xl-8">
        <div class="saas-card">
            <div class="card-header">
                <h6>Revenue Overview</h6>
                <div class="d-flex gap-2">
                    <select class="saas-form-control" style="width: auto; padding: 4px 28px 4px 10px; font-size: 12px; min-width: 120px;">
                        <option>This Year</option>
                        <option>This Month</option>
                        <option>This Week</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="280"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="saas-card">
            <div class="card-header">
                <h6>Sales by Category</h6>
            </div>
            <div class="card-body">
                <canvas id="categoryChart" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Tables Row --}}
<div class="row g-4 mb-4">
    <div class="col-xl-4">
        <div class="saas-card">
            <div class="card-header">
                <h6>Recent Leads</h6>
                <a href="{{ route('admin.leads.index') }}" class="saas-btn saas-btn-ghost saas-btn-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="saas-table-wrapper" style="border: none; box-shadow: none; border-radius: 0;">
                    <table class="saas-table mb-0">
                        <thead>
                            <tr><th>Name</th><th>Company</th><th>Status</th><th>Date</th></tr>
                        </thead>
                        <tbody>
                            @foreach(range(1,5) as $i)
                            <tr>
                                <td><a href="#" class="fw-medium" style="color:var(--ds-primary);text-decoration:none;">John Doe {{ $i }}</a></td>
                                <td>PT Maju Jaya {{ $i }}</td>
                                <td>@include('admin.components.status-badge', ['type' => ['draft','sent','approved','pending','processing'][$i % 5], 'slot' => ['New','Contacted','Qualified','Proposal','Negotiation'][$i % 5]])</td>
                                <td style="color:var(--ds-text-tertiary)">22 Jun 2026</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="saas-card">
            <div class="card-header">
                <h6>Recent Orders</h6>
                <a href="{{ route('admin.orders.index') }}" class="saas-btn saas-btn-ghost saas-btn-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="saas-table-wrapper" style="border: none; box-shadow: none; border-radius: 0;">
                    <table class="saas-table mb-0">
                        <thead>
                            <tr><th>#Order</th><th>Customer</th><th>Total</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @foreach(range(1,5) as $i)
                            <tr>
                                <td><a href="#" style="color:var(--ds-primary);text-decoration:none;font-weight:500;">ORD-2026-{{ str_pad($i,4,'0',STR_PAD_LEFT) }}</a></td>
                                <td>PT Abadi {{ $i }}</td>
                                <td style="font-weight:600;">Rp {{ number_format(rand(500000,50000000), 0, ',', '.') }}</td>
                                <td>@include('admin.components.status-badge', ['type' => ['pending','processing','completed','cancelled','sent'][$i % 5], 'slot' => ['Pending','Processing','Completed','Cancelled','Sent'][$i % 5]])</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="saas-card">
            <div class="card-header">
                <h6>Service Tickets</h6>
                <a href="{{ route('admin.service-tickets.index') }}" class="saas-btn saas-btn-ghost saas-btn-sm">View All</a>
            </div>
            <div class="card-body">
                <canvas id="ticketChart" height="200"></canvas>
                <div class="mt-3 d-flex justify-content-around text-center">
                    <div><span class="saas-badge saas-badge-primary">Open</span><br><strong style="font-size:20px;color:var(--ds-text-primary);">12</strong></div>
                    <div><span class="saas-badge saas-badge-warning">In Progress</span><br><strong style="font-size:20px;color:var(--ds-text-primary);">8</strong></div>
                    <div><span class="saas-badge saas-badge-success">Resolved</span><br><strong style="font-size:20px;color:var(--ds-text-primary);">45</strong></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Top Products --}}
<div class="row g-4">
    <div class="col-12">
        <div class="saas-card">
            <div class="card-header">
                <h6>Top Products</h6>
                <a href="{{ route('admin.products.index') }}" class="saas-btn saas-btn-ghost saas-btn-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="saas-table-wrapper" style="border: none; box-shadow: none; border-radius: 0;">
                    <table class="saas-table mb-0">
                        <thead>
                            <tr><th>Product</th><th>SKU</th><th>Price</th><th>Sold</th><th>Revenue</th><th>Stock</th></tr>
                        </thead>
                        <tbody>
                            @foreach(['Excavator EC220D','Bulldozer D6R','Crane RT100','Conveyor Belt 1200','Hydraulic Press 500T'] as $i => $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:36px;height:36px;background:var(--ds-surface-tertiary);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;color:var(--ds-text-tertiary);"><i class="bi bi-box"></i></div>
                                        <span class="fw-medium">{{ $product }}</span>
                                    </div>
                                </td>
                                <td style="color:var(--ds-text-secondary);">SKU-{{ str_pad($i+1,4,'0',STR_PAD_LEFT) }}</td>
                                <td style="font-weight:500;">Rp {{ number_format(rand(5000000,500000000), 0, ',', '.') }}</td>
                                <td>{{ rand(10,200) }}</td>
                                <td style="font-weight:600;">Rp {{ number_format(rand(50000000,5000000000), 0, ',', '.') }}</td>
                                <td>@include('admin.components.status-badge', ['type' => ['in-stock','low-stock','in-stock','out-of-stock','in-stock'][$i], 'slot' => ['In Stock','Low Stock','In Stock','Out of Stock','In Stock'][$i]])</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    const revCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Revenue 2026',
                data: [2.1, 2.8, 3.2, 3.8, 4.1, 4.5, 5.2, 5.8, 6.1, 6.8, 7.2, 7.8],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.06)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563eb',
                pointRadius: 4
            }, {
                label: 'Revenue 2025',
                data: [1.8, 2.2, 2.6, 3.0, 3.4, 3.7, 4.0, 4.4, 4.7, 5.0, 5.4, 5.6],
                borderColor: '#8b5cf6',
                backgroundColor: 'rgba(139,92,246,0.04)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#8b5cf6',
                pointRadius: 3,
                borderDash: [5,5]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top', labels: { boxWidth: 12, padding: 15, font: { family: "'Inter', sans-serif" } } } },
            scales: {
                y: { beginAtZero: true, ticks: { callback: v => 'Rp ' + v.toFixed(1) + 'M' } }
            }
        }
    });

    const catCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: ['Konstruksi', 'Pertanian', 'Manufaktur', 'Energi', 'Otomasi'],
            datasets: [{
                data: [35, 20, 25, 12, 8],
                backgroundColor: ['#2563eb', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, padding: 12, font: { family: "'Inter', sans-serif" } } }
            },
            cutout: '65%'
        }
    });

    const tixCtx = document.getElementById('ticketChart').getContext('2d');
    new Chart(tixCtx, {
        type: 'doughnut',
        data: {
            labels: ['Open', 'In Progress', 'Resolved'],
            datasets: [{
                data: [12, 8, 45],
                backgroundColor: ['#3b82f6', '#f59e0b', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            cutout: '75%'
        }
    });
});
</script>
@endpush
