<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function index(): View
    {
        $subscribers = NewsletterSubscriber::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.newsletter.index', compact('subscribers'));
    }

    public function show(int $id): View
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);

        return view('admin.newsletter.show', compact('subscriber'));
    }

    public function destroy(int $id): RedirectResponse
    {
        NewsletterSubscriber::findOrFail($id)->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber removed successfully.');
    }
}
