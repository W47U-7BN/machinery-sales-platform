<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\OrderRepositoryInterface;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
    ) {}

    public function index(): View
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return view('customer.orders.index', ['orders' => collect()]);
        }

        $orders = $this->orderRepository->findByCustomer($customer->id);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = $this->orderRepository->with('items', 'shippingTrackings')->find($id);

        return view('customer.orders.show', compact('order'));
    }
}
