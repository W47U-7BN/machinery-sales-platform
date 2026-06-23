<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ServiceTicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceTicketController extends Controller
{
    public function __construct(
        protected ServiceTicketService $ticketService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class);
        $tickets = $repo->with('customer', 'product', 'assignedTo')
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
            'service_type' => 'nullable|string|max:100',
            'warranty_status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $ticket = $this->ticketService->createTicket($validated);

        return response()->json([
            'success' => true,
            'message' => 'Service ticket created successfully.',
            'data' => $ticket,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $ticket = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class)
            ->with('customer', 'product', 'assignedTo', 'activities', 'spareparts')
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $ticket,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $repo = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class);
        $ticket = $repo->update($id, $validated);

        return response()->json([
            'success' => true,
            'message' => 'Service ticket updated successfully.',
            'data' => $ticket,
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $repo = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class);
        $repo->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Service ticket deleted successfully.',
        ]);
    }
}
