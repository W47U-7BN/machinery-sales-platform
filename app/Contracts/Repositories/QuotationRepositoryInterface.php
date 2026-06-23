<?php

namespace App\Contracts\Repositories;

interface QuotationRepositoryInterface extends BaseRepositoryInterface
{
    public function generateNumber();

    public function findByCustomer(int $customerId);

    public function findByStatus(string $status);

    public function findPending();

    public function getRecentQuotations(int $limit = 10);
}
