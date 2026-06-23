<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getMainImage(): ?Media
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('type', 'image')
            ->where('is_main', true)
            ->first();
    }

    public function getImages(): Collection
    {
        return $this->media()->where('type', 'image')->get();
    }

    public function getVideos(): Collection
    {
        return $this->media()->where('type', 'video')->get();
    }

    public function getDocuments(): Collection
    {
        return $this->media()->whereIn('type', ['document', 'pdf'])->get();
    }

    public function addMedia(array $data): Media
    {
        return $this->media()->create($data);
    }

    public function removeMedia(int $mediaId): bool
    {
        return (bool) $this->media()->where('id', $mediaId)->delete();
    }
}
