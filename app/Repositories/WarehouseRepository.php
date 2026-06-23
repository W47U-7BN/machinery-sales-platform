<?php

namespace App\Repositories;

use App\Contracts\Repositories\WarehouseRepositoryInterface;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Log;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    public function __construct(Warehouse $model)
    {
        parent::__construct($model);
    }

    public function findByCode(string $code)
    {
        try {
            return $this->newQuery()
                ->where('code', $code)
                ->firstOrFail();
        } catch (\Throwable $e) {
            Log::error('WarehouseRepository findByCode() error: ' . $e->getMessage(), [
                'code' => $code,
            ]);
            throw $e;
        }
    }

    public function getActive()
    {
        try {
            return $this->newQuery()
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        } catch (\Throwable $e) {
            Log::error('WarehouseRepository getActive() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getMain()
    {
        try {
            return $this->newQuery()
                ->where('is_main', true)
                ->where('is_active', true)
                ->first();
        } catch (\Throwable $e) {
            Log::error('WarehouseRepository getMain() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getWithInventory()
    {
        try {
            return $this->newQuery()
                ->withCount('inventory')
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('WarehouseRepository getWithInventory() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
