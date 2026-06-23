<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ProjectRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectRepositoryInterface $projectRepository,
    ) {}

    public function index(): View
    {
        $projects = $this->projectRepository->with('customer', 'pic')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'created_by' => 'nullable|exists:users,id',
            'pic' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $validated['project_number'] = 'PRJ-' . strtoupper(uniqid());
        $this->projectRepository->create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(int $id): View
    {
        $project = $this->projectRepository->with('customer', 'createdBy', 'pic', 'tasks')->find($id);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(int $id): View
    {
        $project = $this->projectRepository->find($id);

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pic' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'budget' => 'nullable|numeric|min:0',
            'actual_cost' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'priority' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $this->projectRepository->update($id, $validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->projectRepository->delete($id);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
