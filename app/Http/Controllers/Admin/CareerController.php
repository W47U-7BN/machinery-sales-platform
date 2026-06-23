<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::with('department', 'position')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.careers.index', compact('careers'));
    }

    public function create(): View
    {
        $departments = Department::where('is_active', true)->get();
        $positions = Position::where('is_active', true)->get();

        return view('admin.careers.create', compact('departments', 'positions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'employment_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'closing_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        Career::create($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career created successfully.');
    }

    public function show(int $id): View
    {
        $career = Career::with('department', 'position', 'applications')->findOrFail($id);

        return view('admin.careers.show', compact('career'));
    }

    public function edit(int $id): View
    {
        $career = Career::findOrFail($id);
        $departments = Department::where('is_active', true)->get();
        $positions = Position::where('is_active', true)->get();

        return view('admin.careers.edit', compact('career', 'departments', 'positions'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug,' . $id,
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'benefits' => 'nullable|string',
            'employment_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'closing_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        $career->update($validated);

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Career::findOrFail($id)->delete();

        return redirect()->route('admin.careers.index')
            ->with('success', 'Career deleted successfully.');
    }

    public function applications(int $id): View
    {
        $career = Career::findOrFail($id);
        $applications = CareerApplication::where('career_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.careers.applications', compact('career', 'applications'));
    }
}
