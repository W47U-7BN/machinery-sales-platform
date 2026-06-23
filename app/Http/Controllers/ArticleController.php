<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\ArticleCategory;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected SeoService $seoService,
    ) {}

    public function index(Request $request): View
    {
        $query = $request->get('search');
        $categorySlug = $request->get('category');

        if ($query) {
            $articles = $this->articleRepository->search($query);
        } elseif ($categorySlug) {
            $category = ArticleCategory::where('slug', $categorySlug)->firstOrFail();
            $articles = $this->articleRepository->findByCategory($category->id);
        } else {
            $articles = $this->articleRepository->getPublished();
        }

        $categories = ArticleCategory::all();
        $recentArticles = $this->articleRepository->getRecent(5);

        return view('articles.index', compact('articles', 'categories', 'recentArticles'));
    }

    public function show(string $slug): View
    {
        $article = $this->articleRepository->findBySlug($slug);
        $article->increment('views_count');

        $relatedArticles = ArticleCategory::find($article->article_category_id)
            ?->articles()
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->limit(3)
            ->get();

        $seo = $this->seoService->getSeoForModel($article->id, 'article');

        return view('articles.show', compact('article', 'relatedArticles', 'seo'));
    }

    public function category(string $slug): View
    {
        $category = ArticleCategory::where('slug', $slug)->firstOrFail();
        $articles = $this->articleRepository->findByCategory($category->id);
        $categories = ArticleCategory::all();

        return view('articles.category', compact('articles', 'category', 'categories'));
    }
}
