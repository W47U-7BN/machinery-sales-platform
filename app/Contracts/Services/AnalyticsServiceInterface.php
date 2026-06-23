<?php

namespace App\Contracts\Services;

interface AnalyticsServiceInterface
{
    public function getDashboardStats();

    public function getRevenueAnalytics(string $period);

    public function getLeadAnalytics(string $period);

    public function getSalesPerformance(string $period);

    public function getProductPerformance(string $period);

    public function getCustomerAnalytics(string $period);

    public function getServiceAnalytics(string $period);
}
