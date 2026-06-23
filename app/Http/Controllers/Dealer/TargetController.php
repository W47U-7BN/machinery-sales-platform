<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\DealerInformation;
use App\Models\DealerTarget;
use Illuminate\View\View;

class TargetController extends Controller
{
    public function index(): View
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $targets = DealerTarget::where('dealer_id', $dealer->id)
            ->orderBy('period', 'desc')
            ->paginate(20);

        $currentTarget = DealerTarget::where('dealer_id', $dealer->id)
            ->where('period', now()->format('Y-m'))
            ->first();

        return view('dealer.targets.index', compact('targets', 'currentTarget'));
    }
}
