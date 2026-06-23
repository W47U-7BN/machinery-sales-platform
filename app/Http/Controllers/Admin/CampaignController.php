<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\NewsletterSubscriber;
use App\Services\MarketingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function __construct(
        protected MarketingService $marketingService,
    ) {}

    public function index(): View
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create(): View
    {
        $subscriberCount = NewsletterSubscriber::where('is_active', true)->count();

        return view('admin.campaigns.create', compact('subscriberCount'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'scheduled_at' => 'nullable|date',
        ]);

        $validated['total_recipients'] = NewsletterSubscriber::where('is_active', true)->count();

        Campaign::create($validated);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    public function show(int $id): View
    {
        $campaign = Campaign::with('recipients')->findOrFail($id);

        $stats = $this->marketingService->getCampaignStats($id);

        return view('admin.campaigns.show', compact('campaign', 'stats'));
    }

    public function edit(int $id): View
    {
        $campaign = Campaign::findOrFail($id);

        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'scheduled_at' => 'nullable|date',
        ]);

        $campaign->update($validated);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Campaign::findOrFail($id)->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }

    public function send(int $id): RedirectResponse
    {
        $campaign = Campaign::findOrFail($id);

        try {
            $this->marketingService->sendNewsletter($id);
            $campaign->update(['status' => 'sent', 'sent_at' => now()]);

            return redirect()->route('admin.campaigns.index')
                ->with('success', 'Campaign sent successfully.');
        } catch (\RuntimeException $e) {
            return redirect()->route('admin.campaigns.index')
                ->with('error', $e->getMessage());
        }
    }
}
