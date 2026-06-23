<?php

namespace App\Repositories;

use App\Contracts\Repositories\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function findBySlug(string $slug)
    {
        try {
            return $this->newQuery()
                ->where('slug', $slug)
                ->firstOrFail();
        } catch (\Throwable $e) {
            Log::error('BrandRepository findBySlug() error: ' . $e->getMessage(), [
                'slug' => $slug,
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
            Log::error('BrandRepository getActive() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getWithProducts()
    {
        try {
            return $this->newQuery()
                ->has('products')
                ->withCount('products')
                ->orderBy('name')
                ->get();
        } catch (\Throwable $e) {
            Log::error('BrandRepository getWithProducts() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
