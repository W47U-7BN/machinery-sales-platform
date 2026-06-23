<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DownloadCenter;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    public function index(): View
    {
        $downloads = DownloadCenter::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('customer.downloads.index', compact('downloads'));
    }

    public function download(int $id): StreamedResponse
    {
        $download = DownloadCenter::where('id', $id)->where('is_active', true)->firstOrFail();
        $download->increment('download_count');

        return Storage::disk('public')->download($download->file_path);
    }
}
