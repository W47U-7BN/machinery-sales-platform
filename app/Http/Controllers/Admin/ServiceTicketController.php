<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ServiceTicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceTicketController extends Controller
{
    public function __construct(
        protected ServiceTicketService $ticketService,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');
        $repo = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class);

        if ($status) {
            $tickets = $repo->findByStatus($status);
        } else {
            $tickets = $repo->with('customer', 'product', 'assignedTo')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.service-tickets.index', compact('tickets'));
    }

    public function create(): View
    {
        return view('admin.service-tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
            'service_type' => 'nullable|string|max:100',
            'warranty_status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $this->ticketService->createTicket($validated);

        return redirect()->route('admin.service-tickets.index')
            ->with('success', 'Service ticket created successfully.');
    }

    public function show(int $id): View
    {
        $ticket = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class)
            ->with('customer', 'product', 'assignedTo', 'activities', 'spareparts')
            ->find($id);

        return view('admin.service-tickets.show', compact('ticket'));
    }

    public function edit(int $id): View
    {
        $ticket = app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class)->find($id);

        return view('admin.service-tickets.edit', compact('ticket'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'assigned_to' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string|max:20',
            'service_type' => 'nullable|string|max:100',
            'warranty_status' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class)->update($id, $validated);

        return redirect()->route('admin.service-tickets.index')
            ->with('success', 'Service ticket updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        app(\App\Contracts\Repositories\ServiceTicketRepositoryInterface::class)->delete($id);

        return redirect()->route('admin.service-tickets.index')
            ->with('success', 'Service ticket deleted successfully.');
    }

    public function assign(Request $request, int $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'technician_id' => 'required|exists:users,id',
        ]);

        $this->ticketService->assignTicket($ticket, (int) $validated['technician_id']);

        return redirect()->route('admin.service-tickets.index')
            ->with('success', 'Ticket assigned successfully.');
    }

    public function complete(Request $request, int $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'resolution' => 'required|string|max:5000',
        ]);

        $this->ticketService->completeTicket($ticket, $validated['resolution']);

        return redirect()->route('admin.service-tickets.index')
            ->with('success', 'Ticket completed successfully.');
    }
}
