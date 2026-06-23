<?php

namespace App\Repositories;

use App\Contracts\Repositories\SupplierRepositoryInterface;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    public function __construct(Supplier $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        try {
            return $this->newQuery()->where('email', $email)->first();
        } catch (\Throwable $e) {
            Log::error('SupplierRepository findByEmail() error: ' . $e->getMessage(), [
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
                ->orWhere('alternative_phone', $phone)
                ->first();
        } catch (\Throwable $e) {
            Log::error('SupplierRepository findByPhone() error: ' . $e->getMessage(), [
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
                    $query->where('company_name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%")
                        ->orWhere('contact_person', 'like', "%{$term}%");
                })
                ->get();
        } catch (\Throwable $e) {
            Log::error('SupplierRepository search() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }

    public function getActive()
    {
        try {
            return $this->newQuery()
                ->where('is_active', true)
                ->orderBy('company_name')
                ->get();
        } catch (\Throwable $e) {
            Log::error('SupplierRepository getActive() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getTopSuppliers(int $limit = 10)
    {
        try {
            return $this->newQuery()
                ->where('is_active', true)
                ->withCount('purchaseOrders')
                ->orderBy('purchase_orders_count', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('SupplierRepository getTopSuppliers() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
