<?php

namespace App\Services;

use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\WarehouseRepositoryInterface;
use App\Contracts\Services\InventoryServiceInterface;
use App\Models\InventoryMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryService implements InventoryServiceInterface
{
    public function __construct(
        protected InventoryRepositoryInterface $inventoryRepository,
        protected ProductRepositoryInterface $productRepository,
        protected WarehouseRepositoryInterface $warehouseRepository,
    ) {}

    public function getStockLevel(int $productId, int $warehouseId)
    {
        try {
            $inventory = $this->inventoryRepository->findWhere([
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
            ])->first();

            if (!$inventory) {
                return [
                    'product_id' => $productId,
                    'warehouse_id' => $warehouseId,
                    'quantity' => 0,
                ];
            }

            return $inventory;
        } catch (\Throwable $e) {
            Log::error('InventoryService getStockLevel() error: ' . $e->getMessage(), [
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
            ]);
            throw $e;
        }
    }

    public function adjustStock(array $data)
    {
        try {
            DB::beginTransaction();

            $inventory = $this->inventoryRepository->findWhere([
                'product_id' => $data['product_id'],
                'warehouse_id' => $data['warehouse_id'],
            ])->first();

            if ($inventory) {
                $newQuantity = $data['type'] === 'add'
                    ? $inventory->quantity + $data['quantity']
                    : $inventory->quantity - $data['quantity'];

                if ($newQuantity < 0) {
                    throw new \RuntimeException('Insufficient stock.');
                }

                $inventory->update(['quantity' => $newQuantity]);
            } else {
                if ($data['type'] === 'remove') {
                    throw new \RuntimeException('No stock to remove.');
                }

                $inventory = $this->inventoryRepository->create([
                    'product_id' => $data['product_id'],
                    'warehouse_id' => $data['warehouse_id'],
                    'quantity' => $data['quantity'],
                    'minimum_quantity' => $data['minimum_quantity'] ?? 0,
                    'maximum_quantity' => $data['maximum_quantity'] ?? 0,
                ]);
            }

            InventoryMovement::create([
                'product_id' => $data['product_id'],
                'warehouse_id' => $data['warehouse_id'],
                'type' => $data['type'] === 'add' ? 'in' : 'out',
                'quantity' => $data['quantity'],
                'reference_type' => $data['reference_type'] ?? 'adjustment',
                'reference_id' => $data['reference_id'] ?? null,
                'notes' => $data['notes'] ?? 'Stock adjustment',
                'moved_at' => now(),
            ]);

            DB::commit();

            return $inventory->fresh();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('InventoryService adjustStock() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function transferStock(array $data)
    {
        try {
            DB::beginTransaction();

            $result = $this->inventoryRepository->transferStock(
                (int) $data['from_warehouse'],
                (int) $data['to_warehouse'],
                (int) $data['product_id'],
                (float) $data['quantity']
            );

            DB::commit();

            return $result;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('InventoryService transferStock() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getLowStockAlerts()
    {
        try {
            $lowStockItems = $this->inventoryRepository->getLowStock();
            $alerts = [];

            foreach ($lowStockItems as $item) {
                $alerts[] = [
                    'product' => $item->product,
                    'warehouse' => $item->warehouse,
                    'current_quantity' => $item->quantity,
                    'minimum_quantity' => $item->minimum_quantity,
                    'reorder_point' => $item->reorder_point,
                    'status' => $item->quantity <= 0 ? 'out_of_stock' : 'low_stock',
                ];
            }

            return $alerts;
        } catch (\Throwable $e) {
            Log::error('InventoryService getLowStockAlerts() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getInventoryReport(int $warehouseId)
    {
        try {
            $warehouse = $this->warehouseRepository->find($warehouseId);
            $inventory = $this->inventoryRepository->findByWarehouse($warehouseId);

            $totalItems = $inventory->count();
            $totalQuantity = $inventory->sum('quantity');
            $lowStockCount = $inventory->filter(function ($item) {
                return $item->quantity <= $item->minimum_quantity;
            })->count();

            return [
                'warehouse' => $warehouse,
                'total_items' => $totalItems,
                'total_quantity' => $totalQuantity,
                'low_stock_count' => $lowStockCount,
                'inventory' => $inventory,
            ];
        } catch (\Throwable $e) {
            Log::error('InventoryService getInventoryReport() error: ' . $e->getMessage(), [
                'warehouse_id' => $warehouseId,
            ]);
            throw $e;
        }
    }
}
