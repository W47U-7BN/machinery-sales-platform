<?php

namespace App\Services;

use App\Contracts\Repositories\BrandRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\ProductServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected BrandRepositoryInterface $brandRepository,
    ) {}

    public function getCatalogWithFilters(array $filters)
    {
        try {
            $query = $this->productRepository;

            if (!empty($filters['category'])) {
                $query->findByCategory((int) $filters['category']);
            }

            if (!empty($filters['brand'])) {
                $query->findByBrand((int) $filters['brand']);
            }

            if (!empty($filters['search'])) {
                return $this->productRepository->search($filters['search']);
            }

            if (!empty($filters['sort'])) {
                $direction = 'asc';
                if (str_starts_with($filters['sort'], '-')) {
                    $direction = 'desc';
                    $filters['sort'] = substr($filters['sort'], 1);
                }
                $query->orderBy($filters['sort'], $direction);
            }

            $perPage = $filters['per_page'] ?? 12;

            return $query->paginate($perPage);
        } catch (\Throwable $e) {
            Log::error('ProductService getCatalogWithFilters() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getProductDetail(string $slug)
    {
        try {
            $product = $this->productRepository->getBySlug($slug);

            $product->load([
                'category',
                'brand',
                'unit',
                'images',
                'videos',
                'documents',
                'faqs',
                'attributes',
                'reviews',
            ]);

            return $product;
        } catch (\Throwable $e) {
            Log::error('ProductService getProductDetail() error: ' . $e->getMessage(), [
                'slug' => $slug,
            ]);
            throw $e;
        }
    }

    public function searchProducts(string $query)
    {
        try {
            return $this->productRepository->search($query);
        } catch (\Throwable $e) {
            Log::error('ProductService searchProducts() error: ' . $e->getMessage(), [
                'query' => $query,
            ]);
            throw $e;
        }
    }

    public function createProduct(array $data)
    {
        try {
            DB::beginTransaction();

            if (empty($data['slug']) && !empty($data['name'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $product = $this->productRepository->create($data);

            DB::commit();

            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ProductService createProduct() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateProduct(int $id, array $data)
    {
        try {
            DB::beginTransaction();

            if (!empty($data['name']) && empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            }

            $product = $this->productRepository->update($id, $data);

            DB::commit();

            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ProductService updateProduct() error: ' . $e->getMessage(), [
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function deleteProduct(int $id)
    {
        try {
            DB::beginTransaction();

            $result = $this->productRepository->delete($id);

            DB::commit();

            return $result;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ProductService deleteProduct() error: ' . $e->getMessage(), [
                'id' => $id,
            ]);
            throw $e;
        }
    }

    public function updateStock(int $productId, float $quantity, string $type)
    {
        try {
            DB::beginTransaction();

            $adjustedQuantity = $type === 'add' ? $quantity : -$quantity;
            $product = $this->productRepository->updateStock($productId, $adjustedQuantity);

            DB::commit();

            return $product;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ProductService updateStock() error: ' . $e->getMessage(), [
                'product_id' => $productId,
                'type' => $type,
            ]);
            throw $e;
        }
    }
}
