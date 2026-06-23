<?php

namespace App\Http\Controllers;

use App\Models\DownloadCenter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(): View
    {
        $categories = DownloadCenter::where('is_active', true)
            ->whereNotNull('category')
            ->distinct('category')
            ->pluck('category');

        $downloads = DownloadCenter::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('downloads.index', compact('downloads', 'categories'));
    }

    public function download(int $id): StreamedResponse
    {
        $download = DownloadCenter::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        $download->increment('download_count');

        return Storage::disk('public')->download($download->file_path, $download->title . '.' . pathinfo($download->file_path, PATHINFO_EXTENSION));
    }
}
