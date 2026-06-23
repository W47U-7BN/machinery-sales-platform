<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentRepositoryInterface $paymentRepository,
    ) {}

    public function index(Request $request): View
    {
        $method = $request->get('method');

        if ($method) {
            $payments = $this->paymentRepository->findByMethod($method);
        } else {
            $payments = $this->paymentRepository->with('invoice')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.payments.index', compact('payments'));
    }

    public function create(): View
    {
        return view('admin.payments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'received_by' => 'nullable|exists:users,id',
            'payment_date' => 'nullable|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'reference_number' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ]);

        $validated['payment_number'] = 'PAY-' . strtoupper(uniqid());
        $this->paymentRepository->create($validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(int $id): View
    {
        $payment = $this->paymentRepository->with('invoice')->find($id);

        return view('admin.payments.show', compact('payment'));
    }

    public function edit(int $id): View
    {
        $payment = $this->paymentRepository->find($id);

        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'payment_date' => 'nullable|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
            'reference_number' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ]);

        $this->paymentRepository->update($id, $validated);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->paymentRepository->delete($id);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
