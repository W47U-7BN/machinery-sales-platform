<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService,
    ) {}

    public function index(Request $request): View
    {
        $query = $request->get('search');

        if ($query) {
            $customers = $this->customerService->searchCustomers($query);
        } else {
            $customers = app(\App\Contracts\Repositories\CustomerRepositoryInterface::class)->paginate(20);
        }

        return view('admin.customers.index', compact('customers'));
    }

    public function create(): View
    {
        return view('admin.customers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'customer_type' => 'nullable|string|max:100',
            'tax_id' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'alternative_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
            'payment_terms' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $this->customerService->registerCustomer($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(int $id): View
    {
        $customer = $this->customerService->getCustomerProfile($id);
        $orders = $this->customerService->getCustomerOrders($id);
        $quotations = $this->customerService->getCustomerQuotations($id);
        $tickets = $this->customerService->getCustomerTickets($id);

        return view('admin.customers.show', compact('customer', 'orders', 'quotations', 'tickets'));
    }

    public function edit(int $id): View
    {
        $customer = $this->customerService->getCustomerProfile($id);

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'customer_type' => 'nullable|string|max:100',
            'tax_id' => 'nullable|string|max:50',
            'email' => 'required|email|max:255|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'alternative_phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
            'payment_terms' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        app(\App\Contracts\Repositories\CustomerRepositoryInterface::class)->update($id, $validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        app(\App\Contracts\Repositories\CustomerRepositoryInterface::class)->delete($id);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
