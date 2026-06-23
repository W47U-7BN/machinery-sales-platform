<?php

namespace App\Contracts\Repositories;

interface InventoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findByProduct(int $productId);

    public function findByWarehouse(int $warehouseId);

    public function getLowStock();

    public function getStockMovements(int $productId, int $warehouseId);

    public function transferStock(int $fromWarehouse, int $toWarehouse, int $productId, float $quantity);
}
