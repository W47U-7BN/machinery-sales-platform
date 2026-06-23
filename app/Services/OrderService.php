<?php

namespace App\Services;

use App\Contracts\Repositories\InventoryRepositoryInterface;
use App\Contracts\Repositories\OrderRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\OrderServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected ProductRepositoryInterface $productRepository,
        protected InventoryRepositoryInterface $inventoryRepository,
    ) {}

    public function createOrder(array $data)
    {
        try {
            DB::beginTransaction();

            $data['order_number'] = $this->orderRepository->generateNumber();
            $data['order_status'] = $data['order_status'] ?? 'pending';
            $data['payment_status'] = $data['payment_status'] ?? 'pending';

            if (isset($data['items'])) {
                $items = $data['items'];
                unset($data['items']);
            }

            $order = $this->orderRepository->create($data);

            if (isset($items)) {
                foreach ($items as $item) {
                    $order->items()->create($item);
                }

                $order->load('items');
                $this->calculateTotals($order);
            }

            $order->shippingTrackings()->create([
                'status' => 'pending',
                'location' => 'Warehouse',
                'description' => 'Order created',
            ]);

            DB::commit();

            return $order->fresh();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('OrderService createOrder() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function processOrder(int $orderId)
    {
        try {
            DB::beginTransaction();

            $order = $this->orderRepository->update($orderId, [
                'order_status' => 'processing',
            ]);

            DB::commit();

            return $order;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('OrderService processOrder() error: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            throw $e;
        }
    }

    public function shipOrder(int $orderId, array $trackingData)
    {
        try {
            DB::beginTransaction();

            $order = $this->orderRepository->find($orderId);
            $order->load('items');

            $this->orderRepository->update($orderId, [
                'order_status' => 'shipped',
                'shipped_at' => now(),
            ]);

            foreach ($order->items as $item) {
                if ($item->product_id) {
                    $this->inventoryRepository->transferStock(
                        1,
                        2,
                        $item->product_id,
                        $item->quantity
                    );
                }
            }

            $order->shippingTrackings()->create([
                'status' => 'shipped',
                'location' => $trackingData['location'] ?? 'In Transit',
                'description' => $trackingData['description'] ?? 'Order shipped',
                'tracking_number' => $trackingData['tracking_number'] ?? null,
                'courier' => $trackingData['courier'] ?? null,
            ]);

            DB::commit();

            return $order->fresh();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('OrderService shipOrder() error: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            throw $e;
        }
    }

    public function completeOrder(int $orderId)
    {
        try {
            DB::beginTransaction();

            $order = $this->orderRepository->update($orderId, [
                'order_status' => 'delivered',
                'delivered_at' => now(),
            ]);

            $order->shippingTrackings()->create([
                'status' => 'delivered',
                'location' => 'Customer',
                'description' => 'Order delivered successfully',
            ]);

            DB::commit();

            return $order;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('OrderService completeOrder() error: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            throw $e;
        }
    }

    public function cancelOrder(int $orderId, string $reason)
    {
        try {
            DB::beginTransaction();

            $order = $this->orderRepository->update($orderId, [
                'order_status' => 'cancelled',
                'notes' => $reason,
            ]);

            $order->shippingTrackings()->create([
                'status' => 'cancelled',
                'location' => 'Warehouse',
                'description' => $reason,
            ]);

            DB::commit();

            return $order;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('OrderService cancelOrder() error: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            throw $e;
        }
    }

    public function getOrderTimeline(int $orderId)
    {
        try {
            $order = $this->orderRepository->find($orderId);

            return $order->shippingTrackings()
                ->orderBy('created_at', 'asc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('OrderService getOrderTimeline() error: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            throw $e;
        }
    }

    protected function calculateTotals($order): void
    {
        $subtotal = $order->items->sum('subtotal');
        $taxAmount = $order->items->sum('tax');
        $discountAmount = $order->items->sum('discount');
        $totalAmount = $subtotal + $taxAmount - $discountAmount + ($order->shipping_cost ?? 0);

        $order->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => max(0, $totalAmount),
        ]);
    }
}
