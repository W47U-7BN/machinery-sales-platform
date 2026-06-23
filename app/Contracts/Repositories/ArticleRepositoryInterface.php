<?php

namespace App\Contracts\Repositories;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug);

    public function findByCategory(int $categoryId);

    public function search(string $term);

    public function getPublished();

    public function getRecent(int $limit = 5);
}
