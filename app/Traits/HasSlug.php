<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->{$model->getSlugColumn()})) {
                $source = $model->{$model->getSlugSourceColumn()};
                $slug = Str::slug($source);
                $model->{$model->getSlugColumn()} = $model->ensureUniqueSlug($slug);
            }
        });

        static::updating(function (Model $model) {
            $sourceColumn = $model->getSlugSourceColumn();
            $slugColumn = $model->getSlugColumn();

            if ($model->isDirty($sourceColumn) && !$model->isDirty($slugColumn)) {
                $slug = Str::slug($model->{$sourceColumn});
                $model->{$slugColumn} = $model->ensureUniqueSlug($slug, $model->{$slugColumn});
            }
        });
    }

    public function getSlugColumn(): string
    {
        return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
    }

    public function getSlugSourceColumn(): string
    {
        return property_exists($this, 'slugSourceColumn') ? $this->slugSourceColumn : 'name';
    }

    public function ensureUniqueSlug(string $slug, ?string $ignore = null): string
    {
        $query = static::where($this->getSlugColumn(), $slug);

        if ($ignore) {
            $query->where($this->getSlugColumn(), '!=', $ignore);
        }

        if (!$query->exists()) {
            return $slug;
        }

        $counter = 1;
        $baseSlug = $slug;

        while (static::where($this->getSlugColumn(), "{$baseSlug}-{$counter}")
            ->when($ignore, fn($q) => $q->where($this->getSlugColumn(), '!=', $ignore))
            ->exists()
        ) {
            $counter++;
        }

        return "{$baseSlug}-{$counter}";
    }

    public function scopeWhereSlug($query, string $slug): void
    {
        $query->where($this->getSlugColumn(), $slug);
    }
}
