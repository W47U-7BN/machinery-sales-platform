<?php

namespace App\Http\Controllers;

use App\DTOs\LeadData;
use App\Enums\LeadSource;
use App\Enums\LeadStatus;
use App\Services\LeadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuotationRequestController extends Controller
{
    public function __construct(
        protected LeadService $leadService,
    ) {}

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'message' => 'required|string|max:5000',
        ]);

        $leadData = new LeadData(
            title: 'Quotation Request - ' . $validated['name'],
            description: $validated['message'],
            source: LeadSource::Website,
            status: LeadStatus::NewLead,
            customerData: [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'company' => $validated['company'] ?? null,
            ],
            productId: $validated['product_id'] ?? null,
        );

        $this->leadService->captureLead($leadData);

        return redirect()->back()
            ->with('success', 'Your quotation request has been submitted. Our team will contact you shortly.');
    }
}
