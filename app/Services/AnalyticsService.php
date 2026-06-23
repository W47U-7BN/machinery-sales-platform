<?php

namespace App\Services;

use App\Contracts\Repositories\CustomerRepositoryInterface;
use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Contracts\Repositories\InvoiceRepositoryInterface;
use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\ServiceTicketRepositoryInterface;
use App\Contracts\Services\AnalyticsServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalyticsService implements AnalyticsServiceInterface
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected LeadRepositoryInterface $leadRepository,
        protected CustomerRepositoryInterface $customerRepository,
        protected ProductRepositoryInterface $productRepository,
        protected InvoiceRepositoryInterface $invoiceRepository,
        protected InventoryRepositoryInterface $inventoryRepository,
        protected ServiceTicketRepositoryInterface $ticketRepository,
    ) {}

    public function getDashboardStats()
    {
        try {
            $totalRevenue = \App\Models\Order::whereNotIn('status', ['cancelled', 'returned'])->sum('total');

            $totalOrders = $this->orderRepository->all()->count();
            $totalCustomers = $this->customerRepository->all()->count();
            $totalProducts = $this->productRepository->all()->count();
            $pendingOrders = $this->orderRepository->findPending()->count();
            $openTickets = $this->ticketRepository->getOpenTickets()->count();
            $lowStockAlerts = $this->inventoryRepository->getLowStock() ? $this->inventoryRepository->getLowStock()->count() : 0;

            $recentOrders = $this->orderRepository->getRecentOrders(5);
            $recentLeads = $this->leadRepository->getRecentLeads(5);

            return [
                'total_revenue' => $totalRevenue,
                'total_orders' => $totalOrders,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
                'pending_orders' => $pendingOrders,
                'open_tickets' => $openTickets,
                'low_stock_alerts' => $lowStockAlerts,
                'recent_orders' => $recentOrders,
                'recent_leads' => $recentLeads,
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getDashboardStats() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRevenueAnalytics(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $revenueByPeriod = $this->orderRepository->getRevenueByPeriod(
                $dates['start'],
                $dates['end']
            );

            $totalRevenue = $revenueByPeriod->sum('revenue');
            $totalOrders = $revenueByPeriod->sum('total_orders');

            return [
                'period' => $period,
                'date_range' => $dates,
                'total_revenue' => $totalRevenue,
                'total_orders' => $totalOrders,
                'average_order_value' => $totalOrders > 0
                    ? round($totalRevenue / $totalOrders, 2)
                    : 0,
                'daily' => $revenueByPeriod,
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getRevenueAnalytics() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getLeadAnalytics(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $totalLeads = \App\Models\Lead::whereBetween('created_at', [$dates['start'], $dates['end']])->count();

            $leadsBySource = $this->leadRepository->getLeadsBySource();
            $conversionRate = $this->leadRepository->getConversionRate();

            return [
                'period' => $period,
                'total_leads' => $totalLeads,
                'conversion_rate' => $conversionRate,
                'leads_by_source' => $leadsBySource,
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getLeadAnalytics() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSalesPerformance(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $topProducts = $this->orderRepository->getTopProducts();
            $revenueByPeriod = $this->orderRepository->getRevenueByPeriod(
                $dates['start'],
                $dates['end']
            );

            $totalRevenue = $revenueByPeriod->sum('revenue');

            return [
                'period' => $period,
                'total_revenue' => $totalRevenue,
                'top_products' => $topProducts,
                'revenue_trend' => $revenueByPeriod,
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getSalesPerformance() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getProductPerformance(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $topProducts = $this->orderRepository->getTopProducts();
            $lowStock = $this->productRepository->getLowStockProducts();
            $featured = $this->productRepository->getFeatured();

            return [
                'period' => $period,
                'top_selling' => $topProducts,
                'low_stock' => $lowStock,
                'featured_count' => $featured->count(),
                'total_products' => $this->productRepository->all()->count(),
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getProductPerformance() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getCustomerAnalytics(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $totalCustomers = $this->customerRepository->all()->count();
            $recentCustomers = $this->customerRepository->getRecentCustomers(10);
            $outstanding = $this->customerRepository->getWithOutstandingBalance();

            return [
                'period' => $period,
                'total_customers' => $totalCustomers,
                'recent_customers' => $recentCustomers,
                'with_outstanding_balance' => $outstanding->count(),
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getCustomerAnalytics() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getServiceAnalytics(string $period)
    {
        try {
            $dates = $this->getDateRange($period);

            $openTickets = $this->ticketRepository->getOpenTickets()->count();
            $recentTickets = $this->ticketRepository->getRecentTickets(10);

            $totalTickets = $this->ticketRepository->all()->count();

            $resolvedTickets = $this->ticketRepository->findByStatus('completed');
            $resolutionRate = $totalTickets > 0
                ? round(($resolvedTickets->count() / $totalTickets) * 100, 2)
                : 0;

            return [
                'period' => $period,
                'total_tickets' => $totalTickets,
                'open_tickets' => $openTickets,
                'resolution_rate' => $resolutionRate,
                'recent_tickets' => $recentTickets,
            ];
        } catch (\Throwable $e) {
            Log::error('AnalyticsService getServiceAnalytics() error: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function getDateRange(string $period): array
    {
        return match ($period) {
            'today' => [
                'start' => now()->startOfDay()->toDateTimeString(),
                'end' => now()->endOfDay()->toDateTimeString(),
            ],
            'yesterday' => [
                'start' => now()->subDay()->startOfDay()->toDateTimeString(),
                'end' => now()->subDay()->endOfDay()->toDateTimeString(),
            ],
            'this_week' => [
                'start' => now()->startOfWeek()->toDateTimeString(),
                'end' => now()->endOfWeek()->toDateTimeString(),
            ],
            'last_week' => [
                'start' => now()->subWeek()->startOfWeek()->toDateTimeString(),
                'end' => now()->subWeek()->endOfWeek()->toDateTimeString(),
            ],
            'this_month' => [
                'start' => now()->startOfMonth()->toDateTimeString(),
                'end' => now()->endOfMonth()->toDateTimeString(),
            ],
            'last_month' => [
                'start' => now()->subMonth()->startOfMonth()->toDateTimeString(),
                'end' => now()->subMonth()->endOfMonth()->toDateTimeString(),
            ],
            'this_year' => [
                'start' => now()->startOfYear()->toDateTimeString(),
                'end' => now()->endOfYear()->toDateTimeString(),
            ],
            'last_year' => [
                'start' => now()->subYear()->startOfYear()->toDateTimeString(),
                'end' => now()->subYear()->endOfYear()->toDateTimeString(),
            ],
            default => [
                'start' => now()->startOfMonth()->toDateTimeString(),
                'end' => now()->endOfMonth()->toDateTimeString(),
            ],
        };
    }
}
