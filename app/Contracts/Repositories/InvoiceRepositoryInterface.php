<?php

namespace App\Contracts\Repositories;

interface InvoiceRepositoryInterface extends BaseRepositoryInterface
{
    public function generateNumber();

    public function findByCustomer(int $customerId);

    public function findByStatus(string $status);

    public function findOverdue();

    public function getRevenueByPeriod(string $startDate, string $endDate);

    public function getOutstanding();
}
