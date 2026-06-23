<?php

namespace App\Repositories;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function __construct(Article $model)
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
            Log::error('ArticleRepository findBySlug() error: ' . $e->getMessage(), [
                'slug' => $slug,
            ]);
            throw $e;
        }
    }

    public function findByCategory(int $categoryId)
    {
        try {
            return $this->newQuery()
                ->where('category_id', $categoryId)
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ArticleRepository findByCategory() error: ' . $e->getMessage(), [
                'category_id' => $categoryId,
            ]);
            throw $e;
        }
    }

    public function search(string $term)
    {
        try {
            return $this->newQuery()
                ->where(function ($query) use ($term) {
                    $query->where('title', 'like', "%{$term}%")
                        ->orWhere('content', 'like', "%{$term}%")
                        ->orWhere('excerpt', 'like', "%{$term}%");
                })
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ArticleRepository search() error: ' . $e->getMessage(), [
                'term' => $term,
            ]);
            throw $e;
        }
    }

    public function getPublished()
    {
        try {
            return $this->newQuery()
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->get();
        } catch (\Throwable $e) {
            Log::error('ArticleRepository getPublished() error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getRecent(int $limit = 5)
    {
        try {
            return $this->newQuery()
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit($limit)
                ->get();
        } catch (\Throwable $e) {
            Log::error('ArticleRepository getRecent() error: ' . $e->getMessage());
            throw $e;
        }
    }
}
