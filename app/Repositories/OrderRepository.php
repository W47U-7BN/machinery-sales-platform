<?php

namespace App\Repositories;

use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function generateNumber()
    {
        try {
            $prefix = 'ORD-' . now()->format('Ymd');
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
            Log::error('OrderRepository generateNumber() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findByCustomer(int $customerId)
    {
        try {
            return $this->newQuery()
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('OrderRepository findByCustomer() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
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
            Log::error('OrderRepository findByStatus() error: ' . $e->getMessage(), [
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
            Log::error('OrderRepository findPending() error: ' . $e->getMessage());
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
            Log::error('OrderRepository getRecentOrders() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRevenueByPeriod(string $startDate, string $endDate)
    {
        try {
            return $this->newQuery()
                ->whereBetween('order_date', [$startDate, $endDate])
                ->whereNotIn('status', ['cancelled', 'returned'])
                ->select(
                    DB::raw('DATE(order_date) as date'),
                    DB::raw('SUM(total) as revenue'),
                    DB::raw('COUNT(*) as total_orders')
                )
                ->groupBy(DB::raw('DATE(order_date)'))
                ->orderBy('date')
                ->get();
        } catch (\Throwable $e) {
            Log::error('OrderRepository getRevenueByPeriod() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getTopProducts()
    {
        try {
            return $this->newQuery()
                ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->select(
                    'products.id',
                    'products.name',
                    'products.sku',
                    DB::raw('SUM(order_items.quantity) as total_quantity'),
                    DB::raw('SUM(order_items.subtotal) as total_revenue')
                )
                ->whereNotIn('orders.status', ['cancelled', 'returned'])
                ->groupBy('products.id', 'products.name', 'products.sku')
                ->orderBy('total_quantity', 'desc')
                ->limit(20)
                ->get();
        } catch (\Throwable $e) {
            Log::error('OrderRepository getTopProducts() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
