<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealerInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DealerController extends Controller
{
    public function index(): View
    {
        $dealers = DealerInformation::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.dealers.index', compact('dealers'));
    }

    public function create(): View
    {
        return view('admin.dealers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:dealer_informations,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'tax_id' => 'nullable|string|max:50',
            'license_number' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'dealer_type' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        DealerInformation::create($validated);

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Dealer created successfully.');
    }

    public function show(int $id): View
    {
        $dealer = DealerInformation::with('user', 'products', 'commissions')->findOrFail($id);

        return view('admin.dealers.show', compact('dealer'));
    }

    public function edit(int $id): View
    {
        $dealer = DealerInformation::findOrFail($id);

        return view('admin.dealers.edit', compact('dealer'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $dealer = DealerInformation::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:dealer_informations,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'tax_id' => 'nullable|string|max:50',
            'license_number' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'dealer_type' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'commission_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $dealer->update($validated);

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Dealer updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        DealerInformation::findOrFail($id)->delete();

        return redirect()->route('admin.dealers.index')
            ->with('success', 'Dealer deleted successfully.');
    }
}
