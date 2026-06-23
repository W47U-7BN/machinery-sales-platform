<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\InventoryService;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\WarehouseRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService $inventoryService,
        protected ProductRepositoryInterface $productRepository,
        protected WarehouseRepositoryInterface $warehouseRepository,
    ) {}

    public function index(Request $request): View
    {
        $warehouseId = $request->get('warehouse_id');
        $search = $request->get('search');

        if ($warehouseId) {
            $report = $this->inventoryService->getInventoryReport((int) $warehouseId);
            $inventory = $report['inventory'];
        } else {
            $inventory = app(\App\Contracts\Repositories\InventoryRepositoryInterface::class)
                ->with('product', 'warehouse')
                ->paginate(20);
        }

        $warehouses = $this->warehouseRepository->getActive();

        return view('admin.inventory.index', compact('inventory', 'warehouses'));
    }

    public function lowStock(): View
    {
        $lowStockAlerts = $this->inventoryService->getLowStockAlerts();

        return view('admin.inventory.low-stock', compact('lowStockAlerts'));
    }

    public function transfer(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'from_warehouse' => 'required|exists:warehouses,id',
            'to_warehouse' => 'required|exists:warehouses,id|different:from_warehouse',
            'quantity' => 'required|numeric|min:1',
        ]);

        try {
            $this->inventoryService->transferStock($validated);

            return redirect()->route('admin.inventory.index')
                ->with('success', 'Stock transferred successfully.');
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.inventory.index')
                ->with('error', $e->getMessage());
        }
    }

    public function movements(Request $request): View
    {
        $productId = $request->get('product_id');

        if ($productId) {
            $repo = app(\App\Contracts\Repositories\InventoryRepositoryInterface::class);
            $movements = $repo->getStockMovements((int) $productId, 0);
        } else {
            $movements = \App\Models\InventoryMovement::with('product', 'warehouse')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.inventory.movements', compact('movements'));
    }
}
