<?php

namespace App\Contracts\Repositories;

interface PurchaseOrderRepositoryInterface extends BaseRepositoryInterface
{
    public function generateNumber();

    public function findBySupplier(int $supplierId);

    public function findByStatus(string $status);

    public function findPending();

    public function getRecentOrders(int $limit = 10);
}
