<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
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
            Log::error('CategoryRepository findBySlug() error: ' . $e->getMessage(), [
                'slug' => $slug,
            ]);
            throw $e;
        }
    }

    public function getParentCategories()
    {
        try {
            return $this->newQuery()
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->get();
        } catch (\Throwable $e) {
            Log::error('CategoryRepository getParentCategories() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getChildCategories(int $parentId)
    {
        try {
            return $this->newQuery()
                ->where('parent_id', $parentId)
                ->orderBy('sort_order')
                ->get();
        } catch (\Throwable $e) {
            Log::error('CategoryRepository getChildCategories() error: ' . $e->getMessage(), [
                'parent_id' => $parentId,
            ]);
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
            Log::error('CategoryRepository getWithProducts() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
