<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('closing_at')->orWhere('closing_at', '>=', now());
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $departments = Department::where('is_active', true)->get();

        return view('careers.index', compact('careers', 'departments'));
    }

    public function show(string $slug): View
    {
        $career = Career::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedCareers = Career::where('id', '!=', $career->id)
            ->where('is_active', true)
            ->where(function ($q) use ($career) {
                $q->where('department_id', $career->department_id)
                    ->orWhere('employment_type', $career->employment_type);
            })
            ->limit(3)
            ->get();

        return view('careers.show', compact('career', 'relatedCareers'));
    }

    public function apply(Request $request, string $slug): RedirectResponse
    {
        $career = Career::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cover_letter' => 'nullable|string|max:5000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'portfolio_url' => 'nullable|url|max:500',
        ]);

        $resumePath = $request->file('resume')->store('careers/resumes', 'public');

        CareerApplication::create([
            'career_id' => $career->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'resume_path' => $resumePath,
            'portfolio_url' => $validated['portfolio_url'] ?? null,
            'source' => 'website',
            'status' => 'new',
        ]);

        return redirect()->route('careers.show', $slug)
            ->with('success', 'Your application has been submitted successfully.');
    }
}
