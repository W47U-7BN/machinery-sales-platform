<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerCommission;
use App\Models\DealerInformation;
use App\Models\DealerTarget;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $totalOrders = Order::whereHas('customer', function ($q) use ($dealer) {
            $q->where('referral_id', $dealer->id);
        })->count();

        $totalCommissions = DealerCommission::where('dealer_id', $dealer->id)
            ->where('status', 'paid')
            ->sum('amount');

        $pendingCommissions = DealerCommission::where('dealer_id', $dealer->id)
            ->where('status', 'pending')
            ->sum('amount');

        $targets = DealerTarget::where('dealer_id', $dealer->id)
            ->where('period', now()->format('Y-m'))
            ->first();

        return view('dealer.dashboard', compact(
            'dealer', 'totalOrders', 'totalCommissions', 'pendingCommissions', 'targets'
        ));
    }
}
