<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['category', 'brand', 'search', 'sort', 'price_min', 'price_max']);
        $filters['per_page'] = $request->get('per_page', 12);

        $products = $this->productService->getCatalogWithFilters($filters);

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $product = $this->productService->getProductDetail($slug);

        return response()->json([
            'success' => true,
            'data' => $product,
        ]);
    }
}
