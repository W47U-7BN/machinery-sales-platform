<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected SeoService $seoService,
    ) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['category', 'brand', 'search', 'sort', 'price_min', 'price_max']);
        $filters['per_page'] = 12;

        $products = $this->productService->getCatalogWithFilters($filters);

        return view('products.index', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = $this->productService->getProductDetail($slug);
        $relatedProducts = $product->category?->products()
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->limit(6)
            ->get();

        $seo = $this->seoService->getSeoForModel($product->id, 'product');

        return view('products.show', compact('product', 'relatedProducts', 'seo'));
    }
}
