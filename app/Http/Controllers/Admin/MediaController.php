<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function index(): View
    {
        $media = Media::orderBy('created_at', 'desc')->paginate(30);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp,svg,pdf,doc,docx,xls,xlsx,zip|max:102400',
            'collection_name' => 'nullable|string|max:100',
        ]);

        $uploadedFile = $request->file('file');

        $media = Media::create([
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $uploadedFile->store('media/' . date('Y/m'), 'public'),
            'mime_type' => $uploadedFile->getMimeType(),
            'file_size' => $uploadedFile->getSize(),
            'disk' => 'public',
            'collection_name' => $validated['collection_name'] ?? 'default',
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'media' => $media]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media uploaded successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $media = Media::findOrFail($id);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
        $media->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media deleted successfully.');
    }
}
