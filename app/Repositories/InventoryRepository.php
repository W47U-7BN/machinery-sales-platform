<?php

namespace App\Repositories;

use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    public function __construct(Inventory $model)
    {
        parent::__construct($model);
    }

    public function findByProduct(int $productId)
    {
        try {
            return $this->newQuery()
                ->where('product_id', $productId)
                ->with('warehouse')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InventoryRepository findByProduct() error: ' . $e->getMessage(), [
                'product_id' => $productId,
            ]);
            throw $e;
        }
    }

    public function findByWarehouse(int $warehouseId)
    {
        try {
            return $this->newQuery()
                ->where('warehouse_id', $warehouseId)
                ->with('product')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InventoryRepository findByWarehouse() error: ' . $e->getMessage(), [
                'warehouse_id' => $warehouseId,
            ]);
            throw $e;
        }
    }

    public function getLowStock()
    {
        try {
            return $this->newQuery()
                ->whereColumn('quantity', '<=', 'min_quantity')
                ->with('product', 'warehouse')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InventoryRepository getLowStock() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getStockMovements(int $productId, int $warehouseId)
    {
        try {
            return InventoryMovement::query()
                ->where('product_id', $productId)
                ->where('warehouse_id', $warehouseId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InventoryRepository getStockMovements() error: ' . $e->getMessage(), [
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
            ]);
            throw $e;
        }
    }

    public function transferStock(int $fromWarehouse, int $toWarehouse, int $productId, float $quantity)
    {
        try {
            DB::beginTransaction();

            $fromInventory = $this->newQuery()
                ->where('product_id', $productId)
                ->where('warehouse_id', $fromWarehouse)
                ->firstOrFail();

            if ($fromInventory->quantity < $quantity) {
                throw new \RuntimeException('Insufficient stock for transfer.');
            }

            $fromInventory->decrement('quantity', $quantity);

            $toInventory = $this->newQuery()
                ->where('product_id', $productId)
                ->where('warehouse_id', $toWarehouse)
                ->first();

            if ($toInventory) {
                $toInventory->increment('quantity', $quantity);
            } else {
                $this->model->create([
                    'product_id' => $productId,
                    'warehouse_id' => $toWarehouse,
                    'quantity' => $quantity,
                ]);
            }

            InventoryMovement::create([
                'product_id' => $productId,
                'warehouse_id' => $fromWarehouse,
                'type' => 'transfer',
                'quantity' => -$quantity,
                'notes' => "Transferred to warehouse {$toWarehouse}",
            ]);

            InventoryMovement::create([
                'product_id' => $productId,
                'warehouse_id' => $toWarehouse,
                'type' => 'transfer',
                'quantity' => $quantity,
                'notes' => "Transferred from warehouse {$fromWarehouse}",
            ]);

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('InventoryRepository transferStock() error: ' . $e->getMessage(), [
                'from_warehouse' => $fromWarehouse,
                'to_warehouse' => $toWarehouse,
                'product_id' => $productId,
            ]);
            throw $e;
        }
    }
}
