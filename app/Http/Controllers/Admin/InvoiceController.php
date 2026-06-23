<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function __construct(
        protected \App\Contracts\Repositories\InvoiceRepositoryInterface $invoiceRepository,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');

        if ($status) {
            $invoices = $this->invoiceRepository->findByStatus($status);
        } else {
            $invoices = $this->invoiceRepository->with('customer')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'subtotal' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        $validated['invoice_number'] = $this->invoiceRepository->generateNumber();
        $this->invoiceRepository->create($validated);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show(int $id): View
    {
        $invoice = $this->invoiceRepository->with('customer', 'order', 'items')->find($id);

        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(int $id): View
    {
        $invoice = $this->invoiceRepository->find($id);

        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'invoice_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'subtotal' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $this->invoiceRepository->update($id, $validated);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->invoiceRepository->delete($id);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}
