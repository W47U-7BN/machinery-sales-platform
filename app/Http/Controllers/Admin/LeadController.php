<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\LeadRepositoryInterface;
use App\Services\LeadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    public function __construct(
        protected LeadService $leadService,
        protected LeadRepositoryInterface $leadRepository,
    ) {}

    public function index(Request $request): View
    {
        $status = $request->get('status');
        $source = $request->get('source');
        $search = $request->get('search');

        if ($search) {
            $leads = $this->leadRepository->search($search);
        } elseif ($status) {
            $leads = $this->leadRepository->findWhere(['status' => $status]);
        } elseif ($source) {
            $leads = $this->leadRepository->findWhere(['source' => $source]);
        } else {
            $leads = $this->leadRepository->with('customer')->orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.leads.index', compact('leads'));
    }

    public function create(): View
    {
        return view('admin.leads.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'assigned_to' => 'nullable|exists:users,id',
            'source' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_value' => 'nullable|numeric|min:0',
            'expected_close_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $this->leadRepository->create($validated);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead created successfully.');
    }

    public function show(int $id): View
    {
        $lead = $this->leadRepository->with('customer', 'product', 'assignedTo')->find($id);

        return view('admin.leads.show', compact('lead'));
    }

    public function edit(int $id): View
    {
        $lead = $this->leadRepository->find($id);

        return view('admin.leads.edit', compact('lead'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'product_id' => 'nullable|exists:products,id',
            'assigned_to' => 'nullable|exists:users,id',
            'source' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'estimated_value' => 'nullable|numeric|min:0',
            'expected_close_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $this->leadRepository->update($id, $validated);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->leadRepository->delete($id);

        return redirect()->route('admin.leads.index')
            ->with('success', 'Lead deleted successfully.');
    }

    public function convert(int $id): RedirectResponse
    {
        try {
            $this->leadService->convertToCustomer($id);

            return redirect()->route('admin.leads.index')
                ->with('success', 'Lead converted to customer successfully.');
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.leads.show', $id)
                ->with('error', $e->getMessage());
        }
    }
}
