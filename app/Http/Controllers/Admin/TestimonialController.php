<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'content' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($validated['is_approved'] ?? false) {
            $validated['approved_at'] = now();
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function show(int $id): View
    {
        $testimonial = Testimonial::with('customer')->findOrFail($id);

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(int $id): View
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'content' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        if ($validated['is_approved'] ?? false && !$testimonial->approved_at) {
            $validated['approved_at'] = now();
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Testimonial::findOrFail($id)->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
