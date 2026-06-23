<?php

namespace App\Repositories;

use App\Contracts\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        try {
            return $this->newQuery()->where('email', $email)->first();
        } catch (\Throwable $e) {
            Log::error('CustomerRepository findByEmail() error: ' . $e->getMessage(), [
                'email' => $email,
            ]);
            throw $e;
        }
    }

    public function findByPhone(string $phone)
    {
        try {
            return $this->newQuery()
                ->where('phone', $phone)
                ->first();
        } catch (\Throwable $e) {
            Log::error('CustomerRepository findByPhone() error: ' . $e->getMessage(), [
                'phone' => $phone,
            ]);
            throw $e;
        }
    }

    public function search(string $term)
    {
        try {
            return $this->newQuery()
                ->where(function ($query) use ($term) {
                    $query->where('company', 'like', "%{$term}%")
                        ->orWhere('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                })
                ->get();
        } catch (\Throwable $e) {
            Log::error('CustomerRepository search() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }

    public function getWithOutstandingBalance()
    {
        try {
            return $this->newQuery()
                ->whereHas('invoices', function ($query) {
                    $query->where('status', '!=', 'paid')
                        ->where('balance_due', '>', 0);
                })
                ->get();
        } catch (\Throwable $e) {
            Log::error('CustomerRepository getWithOutstandingBalance() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecentCustomers(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('CustomerRepository getRecentCustomers() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
