<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\OrderRepositoryInterface::class);
        $orders = $repo->with('customer', 'items')
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'shipping_address' => 'nullable|string',
            'billing_address' => 'nullable|string',
            'payment_method' => 'nullable|string|max:100',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $order = $this->orderService->createOrder($validated);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully.',
            'data' => $order,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $order = app(\App\Contracts\Repositories\OrderRepositoryInterface::class)
            ->with('customer', 'items', 'shippingTrackings')
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'order_status' => 'nullable|string|max:50',
            'payment_status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $repo = app(\App\Contracts\Repositories\OrderRepositoryInterface::class);
        $order = $repo->update($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully.',
            'data' => $order,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\OrderRepositoryInterface::class);
        $repo->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully.',
        ]);
    }
}
