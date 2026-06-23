<?php

namespace App\Contracts\Repositories;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug);

    public function getParentCategories();

    public function getChildCategories(int $parentId);

    public function getWithProducts();
}
