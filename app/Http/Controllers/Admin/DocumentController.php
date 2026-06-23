<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $query = DocumentManagement::query();
        $category = $request->get('category');

        if ($category) {
            $query->where('category', $category);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = DocumentManagement::whereNotNull('category')->distinct('category')->pluck('category');

        return view('admin.documents.index', compact('documents', 'categories'));
    }

    public function create(): View
    {
        return view('admin.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:51200',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_public' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $file = $request->file('file');

        $validated['file_path'] = $file->store('documents/' . date('Y/m'), 'public');
        $validated['file_type'] = $file->getClientOriginalExtension();
        $validated['file_size'] = $file->getSize();

        if (is_string($validated['tags'] ?? null)) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        DocumentManagement::create($validated);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document created successfully.');
    }

    public function show(int $id): View
    {
        $document = DocumentManagement::findOrFail($id);

        return view('admin.documents.show', compact('document'));
    }

    public function edit(int $id): View
    {
        $document = DocumentManagement::findOrFail($id);

        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $document = DocumentManagement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:51200',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_public' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validated['file_path'] = $file->store('documents/' . date('Y/m'), 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
            $validated['file_size'] = $file->getSize();
        }

        if (is_string($validated['tags'] ?? null)) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $document->update($validated);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        DocumentManagement::findOrFail($id)->delete();

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}
