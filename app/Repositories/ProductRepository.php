<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function findByCategory(int $categoryId)
    {
        try {
            return $this->newQuery()
                ->where('category_id', $categoryId)
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository findByCategory() error: ' . $e->getMessage(), [
                'category_id' => $categoryId,
            ]);
            throw $e;
        }
    }

    public function findByBrand(int $brandId)
    {
        try {
            return $this->newQuery()
                ->where('brand_id', $brandId)
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository findByBrand() error: ' . $e->getMessage(), [
                'brand_id' => $brandId,
            ]);
            throw $e;
        }
    }

    public function findBySku(string $sku)
    {
        try {
            return $this->newQuery()->where('sku', $sku)->first();
        } catch (\Throwable $e) {
            Log::error('ProductRepository findBySku() error: ' . $e->getMessage(), [
                'sku' => $sku,
            ]);
            throw $e;
        }
    }

    public function search(string $term)
    {
        try {
            return $this->newQuery()
                ->where(function ($query) use ($term) {
                    $query->where('name', 'like', "%{$term}%")
                        ->orWhere('sku', 'like', "%{$term}%")
                        ->orWhere('barcode', 'like', "%{$term}%")
                        ->orWhere('short_description', 'like', "%{$term}%");
                })
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository search() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }

    public function getFeatured()
    {
        try {
            return $this->newQuery()
                ->where('is_featured', true)
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository getFeatured() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getBySlug(string $slug)
    {
        try {
            return $this->newQuery()
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        } catch (\Throwable $e) {
            Log::error('ProductRepository getBySlug() error: ' . $e->getMessage(), [
                'slug' => $slug,
            ]);
            throw $e;
        }
    }

    public function getRelatedProducts(int $productId, int $limit = 6)
    {
        try {
            $product = $this->find($productId);

            return $this->newQuery()
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $productId)
                ->where('is_active', true)
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository getRelatedProducts() error: ' . $e->getMessage(), [
                'product_id' => $productId,
            ]);
            throw $e;
        }
    }

    public function updateStock(int $productId, float $quantity)
    {
        try {
            $inventory = \App\Models\Inventory::firstOrCreate(
                ['product_id' => $productId, 'warehouse_id' => 1],
                ['quantity' => 0]
            );
            $inventory->increment('quantity', $quantity);

            return $inventory->fresh();
        } catch (\Throwable $e) {
            Log::error('ProductRepository updateStock() error: ' . $e->getMessage(), [
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            throw $e;
        }
    }

    public function getLowStockProducts()
    {
        try {
            return $this->newQuery()
                ->whereIn('id', \App\Models\Inventory::whereColumn('quantity', '<=', 'min_quantity')
                    ->pluck('product_id'))
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository getLowStockProducts() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getPromoProducts()
    {
        try {
            return $this->newQuery()
                ->whereNotNull('promo_price')
                ->whereColumn('promo_price', '<', 'price')
                ->where('is_active', true)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ProductRepository getPromoProducts() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
