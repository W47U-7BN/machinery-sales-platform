<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DocumentManagement;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(): View
    {
        $documents = DocumentManagement::where('is_active', true)
            ->where('is_public', true)
            ->orWhere(function ($q) {
                $q->whereJsonContains('tags', 'dealer');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dealer.downloads.index', compact('documents'));
    }

    public function download(int $id): StreamedResponse
    {
        $document = DocumentManagement::where('id', $id)->where('is_active', true)->firstOrFail();

        return Storage::disk('public')->download($document->file_path);
    }
}
