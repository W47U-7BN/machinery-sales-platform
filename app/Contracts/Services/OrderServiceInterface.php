<?php

namespace App\Contracts\Services;

interface OrderServiceInterface
{
    public function createOrder(array $data);

    public function processOrder(int $orderId);

    public function shipOrder(int $orderId, array $trackingData);

    public function completeOrder(int $orderId);

    public function cancelOrder(int $orderId, string $reason);

    public function getOrderTimeline(int $orderId);
}
