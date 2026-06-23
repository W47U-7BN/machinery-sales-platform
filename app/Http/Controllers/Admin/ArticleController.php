<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Models\ArticleCategory;
use App\Services\SeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
        protected SeoService $seoService,
    ) {}

    public function index(Request $request): View
    {
        $search = $request->get('search');

        if ($search) {
            $articles = $this->articleRepository->search($search);
        } else {
            $articles = $this->articleRepository->with('category', 'author')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $categories = ArticleCategory::all();

        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'article_category_id' => 'nullable|exists:article_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:draft,published',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if (is_string($validated['tags'] ?? null)) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $validated['author_id'] = $validated['author_id'] ?? auth()->id();
        $validated['status'] = $validated['status'] ?? 'draft';

        $article = app(\App\Contracts\Repositories\ArticleRepositoryInterface::class)->create($validated);
        $this->seoService->updateSeo($article->id, 'article', $validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(int $id): View
    {
        $article = $this->articleRepository->with('category', 'author')->find($id);

        return view('admin.articles.show', compact('article'));
    }

    public function edit(int $id): View
    {
        $article = $this->articleRepository->find($id);
        $categories = ArticleCategory::all();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'article_category_id' => 'nullable|exists:article_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:draft,published',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $validated['status'] = $validated['status'] ?? 'draft';

        if (is_string($validated['tags'] ?? null)) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $this->articleRepository->update($id, $validated);
        $this->seoService->updateSeo($id, 'article', $validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->articleRepository->delete($id);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
