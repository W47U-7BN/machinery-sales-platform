<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\BrandRepositoryInterface;
use App\Services\SeoService;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function __construct(
        protected BrandRepositoryInterface $brandRepository,
        protected SeoService $seoService,
    ) {}

    public function show(string $slug): View
    {
        $brand = $this->brandRepository->findBySlug($slug);
        $products = $brand->products()
            ->where('is_active', true)
            ->paginate(12);

        return view('brands.show', compact('brand', 'products'));
    }
}
