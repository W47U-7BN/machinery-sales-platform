<?php

namespace App\Repositories;

use App\Contracts\Repositories\QuotationRepositoryInterface;
use App\Models\Quotation;
use Illuminate\Support\Facades\Log;

class QuotationRepository extends BaseRepository implements QuotationRepositoryInterface
{
    public function __construct(Quotation $model)
    {
        parent::__construct($model);
    }

    public function generateNumber()
    {
        try {
            $prefix = 'QTN-' . now()->format('Ymd');
            $last = $this->newQuery()
                ->where('quotation_number', 'like', "{$prefix}-%")
                ->orderBy('id', 'desc')
                ->first();

            if (!$last) {
                return "{$prefix}-0001";
            }

            $lastNumber = (int) substr($last->quotation_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

            return "{$prefix}-{$newNumber}";
        } catch (\Throwable $e) {
            Log::error('QuotationRepository generateNumber() error: ' . $e->getMessage());
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
            Log::error('QuotationRepository findByCustomer() error: ' . $e->getMessage(), [
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
            Log::error('QuotationRepository findByStatus() error: ' . $e->getMessage(), [
                'status' => $status,
            ]);
            throw $e;
        }
    }

    public function findPending()
    {
        try {
            return $this->newQuery()
                ->where('status', 'pending')
                ->get();
        } catch (\Throwable $e) {
            Log::error('QuotationRepository findPending() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecentQuotations(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('QuotationRepository getRecentQuotations() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
