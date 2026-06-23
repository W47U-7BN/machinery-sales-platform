<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');
        $paymentStatus = $request->get('payment_status');
        $repo = app(\App\Contracts\Repositories\OrderRepositoryInterface::class);

        if ($status) {
            $orders = $repo->findByStatus($status);
        } else {
            $orders = $repo->with('customer')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function create(): View
    {
        return view('admin.orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'sales_id' => 'nullable|exists:users,id',
            'order_date' => 'nullable|date',
            'shipping_address' => 'nullable|string',
            'billing_address' => 'nullable|string',
            'payment_method' => 'nullable|string|max:100',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $this->orderService->createOrder($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function show(int $id): View
    {
        $order = app(\App\Contracts\Repositories\OrderRepositoryInterface::class)
            ->with('customer', 'items', 'shippingTrackings')
            ->find($id);

        return view('admin.orders.show', compact('order'));
    }

    public function edit(int $id): View
    {
        $order = app(\App\Contracts\Repositories\OrderRepositoryInterface::class)->with('items')->find($id);

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_status' => 'nullable|string|max:50',
            'payment_status' => 'nullable|string|max:50',
            'shipping_address' => 'nullable|string',
            'billing_address' => 'nullable|string',
            'payment_method' => 'nullable|string|max:100',
            'shipping_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        app(\App\Contracts\Repositories\OrderRepositoryInterface::class)->update($id, $validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        app(\App\Contracts\Repositories\OrderRepositoryInterface::class)->delete($id);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
