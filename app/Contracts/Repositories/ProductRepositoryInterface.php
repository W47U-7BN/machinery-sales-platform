<?php

namespace App\Contracts\Repositories;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function findByCategory(int $categoryId);

    public function findByBrand(int $brandId);

    public function findBySku(string $sku);

    public function search(string $term);

    public function getFeatured();

    public function getBySlug(string $slug);

    public function getRelatedProducts(int $productId, int $limit = 6);

    public function updateStock(int $productId, float $quantity);

    public function getLowStockProducts();

    public function getPromoProducts();
}
