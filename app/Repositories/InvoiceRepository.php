<?php

namespace App\Repositories;

use App\Contracts\Repositories\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

    public function generateNumber()
    {
        try {
            $prefix = 'INV-' . now()->format('Ymd');
            $last = $this->newQuery()
                ->where('invoice_number', 'like', "{$prefix}-%")
                ->orderBy('id', 'desc')
                ->first();

            if (!$last) {
                return "{$prefix}-0001";
            }

            $lastNumber = (int) substr($last->invoice_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

            return "{$prefix}-{$newNumber}";
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository generateNumber() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function findByCustomer(int $customerId)
    {
        try {
            return $this->newQuery()
                ->where('customer_id', $customerId)
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository findByCustomer() error: ' . $e->getMessage(), [
                'customer_id' => $customerId,
            ]);
            throw $e;
        }
    }

    public function findByStatus(string $status)
    {
        try {
            return $this->newQuery()
                ->where('status', $status)
                ->get();
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status,
            ]);
            throw $e;
        }
    }

    public function findOverdue()
    {
        try {
            return $this->newQuery()
                ->where('status', 'overdue')
                ->orWhere(function ($query) {
                    $query->whereIn('status', ['pending', 'partial'])
                        ->where('due_date', '<', now());
                })
                ->get();
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository findOverdue() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRevenueByPeriod(string $startDate, string $endDate)
    {
        try {
            return $this->newQuery()
                ->whereBetween('invoice_date', [$startDate, $endDate])
                ->where('status', 'paid')
                ->select(
                    DB::raw('DATE(invoice_date) as date'),
                    DB::raw('SUM(total_amount) as revenue'),
                    DB::raw('COUNT(*) as total_invoices')
                )
                ->groupBy(DB::raw('DATE(invoice_date)'))
                ->orderBy('date')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository getRevenueByPeriod() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getOutstanding()
    {
        try {
            return $this->newQuery()
                ->whereIn('status', ['pending', 'partial', 'overdue'])
                ->where('balance_due', '>', 0)
                ->orderBy('due_date', 'asc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('InvoiceRepository getOutstanding() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
