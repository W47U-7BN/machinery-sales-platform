<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Services\LeadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(
        protected LeadService $leadService,
        protected LeadRepositoryInterface $leadRepository,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $leads = $this->leadRepository->with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $leads,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'source' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'estimated_value' => 'nullable|numeric|min:0',
            'expected_close_date' => 'nullable|date',
            'customer_id' => 'nullable|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'notes' => 'nullable|string',
        ]);

        $lead = $this->leadRepository->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lead created successfully.',
            'data' => $lead,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $lead = $this->leadRepository->with('customer', 'product', 'assignedTo')->find($id);

        return response()->json([
            'success' => true,
            'data' => $lead,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'source' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'estimated_value' => 'nullable|numeric|min:0',
            'expected_close_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $lead = $this->leadRepository->update($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Lead updated successfully.',
            'data' => $lead,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->leadRepository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Lead deleted successfully.',
        ]);
    }
}
