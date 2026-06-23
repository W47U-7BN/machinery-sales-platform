<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __construct(
        protected AnalyticsService $analyticsService,
    ) {}

    public function index(): View
    {
        $reportTypes = [
            'revenue' => 'Revenue Report',
            'sales' => 'Sales Performance',
            'products' => 'Product Performance',
            'leads' => 'Lead Analytics',
            'customers' => 'Customer Analytics',
            'service' => 'Service Analytics',
            'inventory' => 'Inventory Report',
        ];

        return view('admin.reports.index', compact('reportTypes'));
    }

    public function show(string $type, Request $request): View
    {
        $period = $request->get('period', 'this_month');

        $data = match ($type) {
            'revenue' => $this->analyticsService->getRevenueAnalytics($period),
            'sales' => $this->analyticsService->getSalesPerformance($period),
            'products' => $this->analyticsService->getProductPerformance($period),
            'leads' => $this->analyticsService->getLeadAnalytics($period),
            'customers' => $this->analyticsService->getCustomerAnalytics($period),
            'service' => $this->analyticsService->getServiceAnalytics($period),
            'inventory' => app(\App\Services\InventoryService::class)->getLowStockAlerts(),
            default => abort(404),
        };

        return view('admin.reports.show', compact('type', 'period', 'data'));
    }

    public function export(string $type, Request $request)
    {
        $period = $request->get('period', 'this_month');

        $fileName = "{$type}-report-{$period}-" . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $callback = function () use ($type, $period) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Report Type', $type]);
            fputcsv($handle, ['Period', $period]);
            fputcsv($handle, ['Generated At', now()->toDateTimeString()]);
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
