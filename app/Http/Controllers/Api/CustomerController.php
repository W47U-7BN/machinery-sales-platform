<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerService $customerService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $search = $request->get('search');

        if ($search) {
            $customers = $this->customerService->searchCustomers($search);
        } else {
            $customers = app(\App\Contracts\Repositories\CustomerRepositoryInterface::class)
                ->orderBy('created_at', 'desc')
                ->paginate($request->get('per_page', 15));
        }

        return response()->json([
            'success' => true,
            'data' => $customers,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $customer = $this->customerService->registerCustomer($validated);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully.',
            'data' => $customer,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->customerService->getCustomerProfile($id);

        return response()->json([
            'success' => true,
            'data' => $customer,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'company_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $repo = app(\App\Contracts\Repositories\CustomerRepositoryInterface::class);
        $customer = $repo->update($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully.',
            'data' => $customer,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\CustomerRepositoryInterface::class);
        $repo->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully.',
        ]);
    }
}
