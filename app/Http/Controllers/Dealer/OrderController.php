<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DealerInformation;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $dealer = DealerInformation::where('user_id', auth()->id())->firstOrFail();

        $orders = Order::whereHas('customer', function ($q) use ($dealer) {
            $q->where('referral_id', $dealer->id);
        })->with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dealer.orders.index', compact('orders'));
    }

    public function show(int $id): View
    {
        $order = Order::with('customer', 'items')->findOrFail($id);

        return view('dealer.orders.show', compact('order'));
    }
}
