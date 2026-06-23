<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $query = $request->get('search');
        $category = $request->get('category');

        if ($query) {
            $articles = $this->articleRepository->search($query);
        } elseif ($category) {
            $articles = $this->articleRepository->findByCategory((int) $category);
        } else {
            $articles = $this->articleRepository->with('category', 'author')
                ->orderBy('published_at', 'desc')
                ->paginate($request->get('per_page', 10));
        }

        return response()->json([
            'success' => true,
            'data' => $articles,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $article = $this->articleRepository->findBySlug($slug);
        $article->increment('views_count');

        return response()->json([
            'success' => true,
            'data' => $article->load('category', 'author'),
        ]);
    }
}
