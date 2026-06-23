<?php

namespace App\Contracts\Repositories;

interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug(string $slug);

    public function getActive();

    public function getWithProducts();
}
