<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerCommission;
use App\Models\DealerInformation;
use Illuminate\View\View;

class CommissionController extends Controller
{
    public function index(): View
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $commissions = DealerCommission::where('dealer_id', $dealer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalEarned = DealerCommission::where('dealer_id', $dealer->id)
            ->where('status', 'paid')
            ->sum('amount');

        $pendingAmount = DealerCommission::where('dealer_id', $dealer->id)
            ->where('status', 'pending')
            ->sum('amount');

        return view('dealer.commissions.index', compact('commissions', 'totalEarned', 'pendingAmount'));
    }

    public function show(int $id): View
    {
        $commission = DealerCommission::findOrFail($id);

        return view('dealer.commissions.show', compact('commission'));
    }
}
