<?php

namespace App\Contracts\Repositories;

interface PaymentRepositoryInterface extends BaseRepositoryInterface
{
    public function findByInvoice(int $invoiceId);

    public function findByMethod(string $method);

    public function getPaymentsByDateRange(string $startDate, string $endDate);

    public function getTotalCollected(string $startDate, string $endDate);
}
