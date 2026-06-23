<?php

namespace App\Contracts\Repositories;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function generateNumber();

    public function findByCustomer(int $customerId);

    public function findByStatus(string $status);

    public function findPending();

    public function getRecentOrders(int $limit = 10);

    public function getRevenueByPeriod(string $startDate, string $endDate);

    public function getTopProducts();
}
