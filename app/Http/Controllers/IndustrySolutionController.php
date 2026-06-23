<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustrySolutionController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    ) {}

    public function show(string $slug): View
    {
        $category = $this->categoryRepository->findBySlug($slug);
        $category->load(['products' => function ($q) {
            $q->where('is_active', true)->limit(20);
        }, 'children']);

        return view('solutions.show', compact('category'));
    }
}
