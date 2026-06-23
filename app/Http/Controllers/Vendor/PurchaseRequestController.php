<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\PurchaseRequest;
use Illuminate\View\View;

class PurchaseRequestController extends Controller
{
    public function index(): View
    {
        $vendor = \App\Models\VendorInformation::where('user_id', auth()->id())->firstOrFail();

        $purchaseRequests = PurchaseRequest::whereHas('items', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('vendor.purchase-requests.index', compact('purchaseRequests'));
    }

    public function show(int $id): View
    {
        $purchaseRequest = PurchaseRequest::with('items.product', 'createdBy')
            ->findOrFail($id);

        return view('vendor.purchase-requests.show', compact('purchaseRequest'));
    }
}
