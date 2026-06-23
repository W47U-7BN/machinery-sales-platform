<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Services\ProductService;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected ArticleRepositoryInterface $articleRepository,
        protected CategoryRepositoryInterface $categoryRepository,
    ) {}

    public function index(Request $request): View
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return view('search.index', [
                'products' => collect(),
                'articles' => collect(),
                'query' => $query,
            ]);
        }

        $products = $this->productService->searchProducts($query);
        $articles = $this->articleRepository->search($query);

        return view('search.index', compact('products', 'articles', 'query'));
    }
}
