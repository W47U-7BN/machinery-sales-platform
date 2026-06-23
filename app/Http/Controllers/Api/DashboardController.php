<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected AnalyticsService $analyticsService,
    ) {}

    public function stats(): JsonResponse
    {
        $stats = $this->analyticsService->getDashboardStats();

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    public function revenue(Request $request): JsonResponse
    {
        $period = $request->get('period', 'this_month');
        $data = $this->analyticsService->getRevenueAnalytics($period);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function leads(Request $request): JsonResponse
    {
        $period = $request->get('period', 'this_month');
        $data = $this->analyticsService->getLeadAnalytics($period);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function sales(Request $request): JsonResponse
    {
        $period = $request->get('period', 'this_month');
        $data = $this->analyticsService->getSalesPerformance($period);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
