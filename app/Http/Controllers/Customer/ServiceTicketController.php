<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ServiceTicketRepositoryInterface;
use App\Services\ServiceTicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceTicketController extends Controller
{
    public function __construct(
        protected ServiceTicketService $ticketService,
        protected ServiceTicketRepositoryInterface $ticketRepository,
    ) {}

    public function index(): View
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return view('customer.service-tickets.index', ['tickets' => collect()]);
        }

        $tickets = $this->ticketRepository->findByCustomer($customer->id);

        return view('customer.service-tickets.index', compact('tickets'));
    }

    public function show(int $id): View
    {
        $ticket = $this->ticketRepository->with('activities', 'spareparts')->find($id);

        return view('customer.service-tickets.show', compact('ticket'));
    }

    public function create(): View
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();
        $products = $customer?->orders()->with('items.product')->get()->pluck('items.*.product')->flatten()->unique('id');

        return view('customer.service-tickets.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $customer = \App\Models\Customer::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'nullable|string|max:20',
        ]);

        $validated['customer_id'] = $customer->id;
        $this->ticketService->createTicket($validated);

        return redirect()->route('customer.service-tickets.index')
            ->with('success', 'Service ticket created successfully.');
    }
}
