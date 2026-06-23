<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct(
        protected QuotationService $quotationService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\QuotationRepositoryInterface::class);
        $quotations = $repo->with('customer', 'items')
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $quotations,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'lead_id' => 'nullable|exists:leads,id',
            'title' => 'nullable|string|max:255',
            'valid_until' => 'nullable|date',
            'terms_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $quotation = $this->quotationService->createQuotation($validated);

        return response()->json([
            'success' => true,
            'message' => 'Quotation created successfully.',
            'data' => $quotation,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $quotation = $this->quotationService->getQuotationPdf($id);

        return response()->json([
            'success' => true,
            'data' => $quotation,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|exists:customers,id',
            'title' => 'nullable|string|max:255',
            'valid_until' => 'nullable|date',
            'terms_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $repo = app(\App\Contracts\Repositories\QuotationRepositoryInterface::class);
        $quotation = $repo->update($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Quotation updated successfully.',
            'data' => $quotation,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\QuotationRepositoryInterface::class);
        $repo->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Quotation deleted successfully.',
        ]);
    }

    public function approve(int $id): JsonResponse
    {
        $quotation = $this->quotationService->approveQuotation($id);

        return response()->json([
            'success' => true,
            'message' => 'Quotation approved successfully.',
            'data' => $quotation,
        ]);
    }

    public function reject(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate(['reason' => 'required|string|max:1000']);
        $quotation = $this->quotationService->rejectQuotation($id, $validated['reason']);

        return response()->json([
            'success' => true,
            'message' => 'Quotation rejected.',
            'data' => $quotation,
        ]);
    }
}
