<?php

namespace App\Services;

use App\Contracts\Services\SeoServiceInterface;
use Illuminate\Support\Facades\Log;

class SeoService implements SeoServiceInterface
{
    public function updateSeo(int $modelId, string $modelType, array $data)
    {
        try {
            $model = $this->resolveModel($modelType, $modelId);

            $seoData = [
                'meta_title' => $data['meta_title'] ?? $data['title'] ?? null,
                'meta_description' => $data['meta_description'] ?? $data['description'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null,
            ];

            $seoData = array_filter($seoData);

            if (!empty($seoData)) {
                $model->update($seoData);
            }

            return $model->fresh();
        } catch (\Throwable $e) {
            Log::error('SeoService updateSeo() error: ' . $e->getMessage(), [
                'model_id' => $modelId,
                'model_type' => $modelType,
            ]);
            throw $e;
        }
    }

    public function getSeoForModel(int $modelId, string $modelType)
    {
        try {
            $model = $this->resolveModel($modelType, $modelId);

            return [
                'meta_title' => $model->meta_title ?? $model->title ?? $model->name ?? null,
                'meta_description' => $model->meta_description ?? null,
                'meta_keywords' => $model->meta_keywords ?? null,
                'url' => url()->current(),
                'image' => $model->featured_image ?? $model->image ?? null,
            ];
        } catch (\Throwable $e) {
            Log::error('SeoService getSeoForModel() error: ' . $e->getMessage(), [
                'model_id' => $modelId,
                'model_type' => $modelType,
            ]);
            throw $e;
        }
    }

    public function generateSchemaMarkup(string $type, mixed $model)
    {
        try {
            return match ($type) {
                'product' => $this->productSchema($model),
                'article' => $this->articleSchema($model),
                'organization' => $this->organizationSchema(),
                'breadcrumb' => $this->breadcrumbSchema($model),
                'faq' => $this->faqSchema($model),
                default => null,
            };
        } catch (\Throwable $e) {
            Log::error('SeoService generateSchemaMarkup() error: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function productSchema($product): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => $product->short_description,
            'sku' => $product->sku,
            'image' => $product->featured_image,
            'offers' => [
                '@type' => 'Offer',
                'price' => $product->selling_price,
                'priceCurrency' => 'IDR',
                'availability' => $product->is_active
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
            ],
        ];
    }

    protected function articleSchema($article): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $article->title,
            'description' => $article->excerpt,
            'datePublished' => $article->published_at?->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $article->author?->name ?? 'Admin',
            ],
        ];
    }

    protected function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('app.name'),
            'url' => config('app.url'),
        ];
    }

    protected function breadcrumbSchema(array $crumbs): array
    {
        $items = [];
        $position = 1;

        foreach ($crumbs as $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $position++,
                'name' => $crumb['name'],
                'item' => $crumb['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    protected function faqSchema($faqs): array
    {
        $items = [];

        foreach ($faqs as $faq) {
            $items[] = [
                '@type' => 'Question',
                'name' => $faq->question,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq->answer,
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $items,
        ];
    }

    protected function resolveModel(string $modelType, int $modelId)
    {
        if ($modelType === 'organization') {
            return \App\Models\CompanyInformation::first() ?? new \App\Models\CompanyInformation();
        }

        $modelClass = match ($modelType) {
            'product' => \App\Models\Product::class,
            'category' => \App\Models\Category::class,
            'article' => \App\Models\Article::class,
            'brand' => \App\Models\Brand::class,
            default => throw new \InvalidArgumentException("Unsupported model type: {$modelType}"),
        };

        $model = app($modelClass);

        return $model->findOrFail($modelId);
    }
}
