<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected CustomerService $customerService,
    ) {}

    public function index(): View
    {
        $user = auth()->user();
        $customer = \App\Models\Customer::where('user_id', $user->id)->first();

        $orders = $customer ? $this->customerService->getCustomerOrders($customer->id) : collect();
        $quotations = $customer ? $this->customerService->getCustomerQuotations($customer->id) : collect();
        $tickets = $customer ? $this->customerService->getCustomerTickets($customer->id) : collect();

        return view('customer.dashboard', compact('user', 'customer', 'orders', 'quotations', 'tickets'));
    }
}
