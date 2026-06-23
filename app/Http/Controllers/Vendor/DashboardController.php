<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\VendorInformation;
use App\Models\PurchaseRequest;
use App\Models\Payment;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $vendor = VendorInformation::where('user_id', auth()->id())->firstOrFail();

        $totalPurchaseRequests = PurchaseRequest::whereHas('items', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->count();

        $pendingPurchaseRequests = PurchaseRequest::whereHas('items', function ($q) use ($vendor) {
            $q->where('vendor_id', $vendor->id);
        })->where('status', 'pending')->count();

        $totalPayments = Payment::where('received_by', auth()->id())
            ->where('status', 'completed')
            ->sum('amount');

        $productsCount = \App\Models\VendorProduct::where('vendor_id', $vendor->id)->count();

        return view('vendor.dashboard', compact(
            'vendor', 'totalPurchaseRequests', 'pendingPurchaseRequests',
            'totalPayments', 'productsCount'
        ));
    }
}
