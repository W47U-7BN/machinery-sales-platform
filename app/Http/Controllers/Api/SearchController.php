<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected ArticleRepositoryInterface $articleRepository,
    ) {}

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'data' => [
                    'products' => [],
                    'articles' => [],
                    'query' => $query,
                ],
            ]);
        }

        $products = $this->productService->searchProducts($query);
        $articles = $this->articleRepository->search($query);

        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products,
                'articles' => $articles,
                'query' => $query,
            ],
        ]);
    }
}
