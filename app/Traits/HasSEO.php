<?php

namespace App\Traits;

use App\Models\SEO;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSEO
{
    public static function bootHasSEO(): void
    {
        static::deleting(function ($model) {
            $model->seo()->delete();
        });
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SEO::class, 'seoable');
    }

    public function metaTitle(): ?string
    {
        return $this->seo?->meta_title;
    }

    public function metaDescription(): ?string
    {
        return $this->seo?->meta_description;
    }

    public function metaKeywords(): ?string
    {
        return $this->seo?->meta_keywords;
    }

    public function ogImage(): ?string
    {
        return $this->seo?->og_image;
    }

    public function updateSEO(array $data): SEO
    {
        if ($this->seo) {
            $this->seo->update($data);

            return $this->seo->fresh();
        }

        return $this->seo()->create($data);
    }
}
