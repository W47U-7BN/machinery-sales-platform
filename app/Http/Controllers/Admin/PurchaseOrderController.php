<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\PurchaseOrderRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseOrderController extends Controller
{
    public function __construct(
        protected PurchaseOrderRepositoryInterface $poRepository,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');

        if ($status) {
            $purchaseOrders = $this->poRepository->findByStatus($status);
        } else {
            $purchaseOrders = $this->poRepository->with('supplier')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.purchase-orders.index', compact('purchaseOrders'));
    }

    public function create(): View
    {
        return view('admin.purchase-orders.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_request_id' => 'nullable|exists:purchase_requests,id',
            'created_by' => 'nullable|exists:users,id',
            'order_date' => 'nullable|date',
            'expected_delivery_date' => 'nullable|date',
            'subtotal' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        $validated['order_number'] = $this->poRepository->generateNumber();
        $this->poRepository->create($validated);

        return redirect()->route('admin.purchase-orders.index')
            ->with('success', 'Purchase order created successfully.');
    }

    public function show(int $id): View
    {
        $purchaseOrder = $this->poRepository->with('supplier', 'items')->find($id);

        return view('admin.purchase-orders.show', compact('purchaseOrder'));
    }

    public function edit(int $id): View
    {
        $purchaseOrder = $this->poRepository->with('items')->find($id);

        return view('admin.purchase-orders.edit', compact('purchaseOrder'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'expected_delivery_date' => 'nullable|date',
            'subtotal' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $this->poRepository->update($id, $validated);

        return redirect()->route('admin.purchase-orders.index')
            ->with('success', 'Purchase order updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->poRepository->delete($id);

        return redirect()->route('admin.purchase-orders.index')
            ->with('success', 'Purchase order deleted successfully.');
    }
}
