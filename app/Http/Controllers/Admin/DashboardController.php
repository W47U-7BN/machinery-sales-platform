<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected AnalyticsService $analyticsService,
    ) {}

    public function index(): View
    {
        $stats = $this->analyticsService->getDashboardStats();

        return view('admin.dashboard', compact('stats'));
    }

    public function analytics(Request $request): View
    {
        $period = $request->get('period', 'this_month');

        $revenue = $this->analyticsService->getRevenueAnalytics($period);
        $leads = $this->analyticsService->getLeadAnalytics($period);
        $sales = $this->analyticsService->getSalesPerformance($period);
        $products = $this->analyticsService->getProductPerformance($period);
        $customers = $this->analyticsService->getCustomerAnalytics($period);
        $services = $this->analyticsService->getServiceAnalytics($period);

        return view('admin.analytics', compact(
            'period', 'revenue', 'leads', 'sales', 'products', 'customers', 'services'
        ));
    }
}
