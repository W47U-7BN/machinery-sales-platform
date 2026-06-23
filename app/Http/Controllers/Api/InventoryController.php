<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InventoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $warehouseId = $request->get('warehouse_id');

        if ($warehouseId) {
            $report = $this->inventoryService->getInventoryReport((int) $warehouseId);
            $data = $report;
        } else {
            $data = app(\App\Contracts\Repositories\InventoryRepositoryInterface::class)
                ->with('product', 'warehouse')
                ->paginate($request->get('per_page', 15));
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function lowStock(): JsonResponse
    {
        $alerts = $this->inventoryService->getLowStockAlerts();

        return response()->json([
            'success' => true,
            'data' => $alerts,
        ]);
    }
}
