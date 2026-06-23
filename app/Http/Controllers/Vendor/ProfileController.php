<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $vendor = VendorInformation::where('user_id', auth()->id())->firstOrFail();

        return view('vendor.profile.edit', compact('vendor'));
    }

    public function update(Request $request): RedirectResponse
    {
        $vendor = VendorInformation::where('user_id', auth()->id())->firstOrFail();

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

        $vendor->update($validated);

        return redirect()->route('vendor.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
