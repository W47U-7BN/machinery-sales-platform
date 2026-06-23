<?php

namespace App\Repositories;

use App\Contracts\Repositories\PurchaseOrderRepositoryInterface;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Log;

class PurchaseOrderRepository extends BaseRepository implements PurchaseOrderRepositoryInterface
{
    public function __construct(PurchaseOrder $model)
    {
        parent::__construct($model);
    }

    public function generateNumber()
    {
        try {
            $prefix = 'PO-' . now()->format('Ymd');
            $last = $this->newQuery()
                ->where('order_number', 'like', "{$prefix}-%")
                ->orderBy('id', 'desc')
                ->first();

            if (!$last) {
                return "{$prefix}-0001";
            }

            $lastNumber = (int) substr($last->order_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

            return "{$prefix}-{$newNumber}";
        } catch (\Throwable $e) {
            Log::error('PurchaseOrderRepository generateNumber() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findBySupplier(int $supplierId)
    {
        try {
            return $this->newQuery()
                ->where('supplier_id', $supplierId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PurchaseOrderRepository findBySupplier() error: ' . $e->getMessage(), [
                'supplier_id' => $supplierId,
            ]);
            throw $e;
        }
    }

    public function findByStatus(string $status)
    {
        try {
            return $this->newQuery()
                ->where('status', $status)
                ->get();
        } catch (\Throwable $e) {
            Log::error('PurchaseOrderRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status,
            ]);
            throw $e;
        }
    }

    public function findPending()
    {
        try {
            return $this->newQuery()
                ->where('status', 'pending')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PurchaseOrderRepository findPending() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecentOrders(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('PurchaseOrderRepository getRecentOrders() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
