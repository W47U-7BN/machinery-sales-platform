<?php

namespace App\Contracts\Services;

interface ProductServiceInterface
{
    public function getCatalogWithFilters(array $filters);

    public function getProductDetail(string $slug);

    public function searchProducts(string $query);

    public function createProduct(array $data);

    public function updateProduct(int $id, array $data);

    public function deleteProduct(int $id);

    public function updateStock(int $productId, float $quantity, string $type);
}
