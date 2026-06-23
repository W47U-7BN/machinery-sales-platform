<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Services\ProductService;
use App\Services\SeoService;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProductService $productService,
        protected SeoService $seoService,
    ) {}

    public function show(string $slug): View
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $category->load('children', 'parent');

        $products = $category->products()
            ->where('is_active', true)
            ->paginate(12);

        $seo = $this->seoService->getSeoForModel($category->id, 'category');

        return view('categories.show', compact('category', 'products', 'seo'));
    }
}
