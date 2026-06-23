<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::where('received_by', auth()->id())
            ->with('invoice')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $totalPaid = Payment::where('received_by', auth()->id())
            ->where('status', 'completed')
            ->sum('amount');

        $totalPending = Payment::where('received_by', auth()->id())
            ->where('status', 'pending')
            ->sum('amount');

        return view('vendor.payments.index', compact('payments', 'totalPaid', 'totalPending'));
    }

    public function show(int $id): View
    {
        $payment = Payment::with('invoice')->findOrFail($id);

        return view('vendor.payments.show', compact('payment'));
    }
}
