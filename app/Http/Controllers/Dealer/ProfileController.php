<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        return view('dealer.profile.edit', compact('dealer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
        ]);

        $dealer->update($validated);

        $user = auth()->user();
        $user->update(['name' => $request->input('company_name')]);

        return redirect()->route('dealer.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
