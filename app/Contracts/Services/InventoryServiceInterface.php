<?php

namespace App\Contracts\Services;

interface InventoryServiceInterface
{
    public function getStockLevel(int $productId, int $warehouseId);

    public function adjustStock(array $data);

    public function transferStock(array $data);

    public function getLowStockAlerts();

    public function getInventoryReport(int $warehouseId);
}
