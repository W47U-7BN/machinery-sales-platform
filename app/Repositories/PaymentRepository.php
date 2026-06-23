<?php

namespace App\Repositories;

use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function findByInvoice(int $invoiceId)
    {
        try {
            return $this->newQuery()
                ->where('invoice_id', $invoiceId)
                ->orderBy('payment_date', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PaymentRepository findByInvoice() error: ' . $e->getMessage(), [
                'invoice_id' => $invoiceId,
            ]);
            throw $e;
        }
    }

    public function findByMethod(string $method)
    {
        try {
            return $this->newQuery()
                ->where('payment_method', $method)
                ->orderBy('payment_date', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PaymentRepository findByMethod() error: ' . $e->getMessage(), [
                'method' => $method,
            ]);
            throw $e;
        }
    }

    public function getPaymentsByDateRange(string $startDate, string $endDate)
    {
        try {
            return $this->newQuery()
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->orderBy('payment_date', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PaymentRepository getPaymentsByDateRange() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getTotalCollected(string $startDate, string $endDate)
    {
        try {
            return $this->newQuery()
                ->whereBetween('payment_date', [$startDate, $endDate])
                ->where('status', 'completed')
                ->select(
                    DB::raw('DATE(payment_date) as date'),
                    DB::raw('SUM(amount) as total'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy(DB::raw('DATE(payment_date)'))
                ->orderBy('date')
                ->get();
        } catch (\Throwable $e) {
            Log::error('PaymentRepository getTotalCollected() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
