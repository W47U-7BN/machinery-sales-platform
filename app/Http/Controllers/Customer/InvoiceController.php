<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\InvoiceRepositoryInterface;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function __construct(
        protected InvoiceRepositoryInterface $invoiceRepository,
    ) {}

    public function index(): View
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return view('customer.invoices.index', ['invoices' => collect()]);
        }

        $invoices = $this->invoiceRepository->findByCustomer($customer->id);

        return view('customer.invoices.index', compact('invoices'));
    }

    public function show(int $id): View
    {
        $invoice = $this->invoiceRepository->with('items')->find($id);

        return view('customer.invoices.show', compact('invoice'));
    }

    public function download(int $id)
    {
        $invoice = $this->invoiceRepository->find($id);

        return view('customer.invoices.pdf', compact('invoice'));
    }
}
