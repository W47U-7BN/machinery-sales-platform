<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\QuotationRepositoryInterface;
use Illuminate\View\View;

class QuotationController extends Controller
{
    public function __construct(
        protected QuotationRepositoryInterface $quotationRepository,
    ) {}

    public function index(): View
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return view('customer.quotations.index', ['quotations' => collect()]);
        }

        $quotations = $this->quotationRepository->findByCustomer($customer->id);

        return view('customer.quotations.index', compact('quotations'));
    }

    public function show(int $id): View
    {
        $quotation = $this->quotationRepository->with('items')->find($id);

        return view('customer.quotations.show', compact('quotation'));
    }
}
