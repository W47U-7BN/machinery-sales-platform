<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QuotationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuotationController extends Controller
{
    public function __construct(
        protected QuotationService $quotationService,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');
        $repo = app(\App\Contracts\Repositories\QuotationRepositoryInterface::class);

        if ($status) {
            $quotations = $repo->findByStatus($status);
        } else {
            $quotations = $repo->with('customer')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.quotations.index', compact('quotations'));
    }

    public function create(): View
    {
        return view('admin.quotations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'lead_id' => 'nullable|exists:leads,id',
            'sales_id' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
            'valid_until' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'terms_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.discount' => 'nullable|numeric|min:0',
            'items.*.tax' => 'nullable|numeric|min:0',
        ]);

        $this->quotationService->createQuotation($validated);

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    public function show(int $id): View
    {
        $quotation = $this->quotationService->getQuotationPdf($id);

        return view('admin.quotations.show', compact('quotation'));
    }

    public function edit(int $id): View
    {
        $quotation = app(\App\Contracts\Repositories\QuotationRepositoryInterface::class)->with('items')->find($id);

        return view('admin.quotations.edit', compact('quotation'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'lead_id' => 'nullable|exists:leads,id',
            'sales_id' => 'nullable|exists:users,id',
            'title' => 'nullable|string|max:255',
            'valid_until' => 'nullable|date',
            'status' => 'nullable|string|max:50',
            'terms_conditions' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        app(\App\Contracts\Repositories\QuotationRepositoryInterface::class)->update($id, $validated);

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        app(\App\Contracts\Repositories\QuotationRepositoryInterface::class)->delete($id);

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }

    public function approve(int $id): RedirectResponse
    {
        $this->quotationService->approveQuotation($id);

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation approved successfully.');
    }

    public function reject(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate(['reason' => 'required|string|max:1000']);
        $this->quotationService->rejectQuotation($id, $validated['reason']);

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation rejected.');
    }

    public function pdf(int $id)
    {
        $quotation = $this->quotationService->getQuotationPdf($id);

        return view('admin.quotations.pdf', compact('quotation'));
    }
}
