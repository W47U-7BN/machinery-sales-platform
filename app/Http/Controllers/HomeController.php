<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\AnalyticsService;
use App\Services\SeoService;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected AnalyticsService $analyticsService,
        protected SeoService $seoService,
    ) {}

    public function index(): View
    {
        $stats = $this->analyticsService->getDashboardStats();
        $featuredProducts = $this->productService->getCatalogWithFilters(['is_featured' => true, 'per_page' => 8]);

        $seo = $this->seoService->getSeoForModel(0, 'organization');

        return view('landing.index', compact('featuredProducts', 'stats', 'seo'));
    }
}
