<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getWithProducts();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $category->load(['children', 'products' => function ($q) {
            $q->where('is_active', true)->limit(20);
        }]);

        return response()->json([
            'success' => true,
            'data' => $category,
        ]);
    }
}
