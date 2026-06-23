<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTimeline
{
    public function timeline(): MorphMany
    {
        return $this->activities();
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(
            config('activitylog.activity_model', 'Spatie\\Activitylog\\Models\\Activity'),
            'subject'
        );
    }

    public function scopeWithRecentActivity($query, int $limit = 10): void
    {
        $query->with(['activities' => function ($q) use ($limit) {
            $q->latest()->limit($limit);
        }]);
    }

    public function scopeWhereActivityType($query, string $event): void
    {
        $query->whereHas('activities', function ($q) use ($event) {
            $q->where('event', $event);
        });
    }

    public function getLatestActivity()
    {
        return $this->activities()->latest()->first();
    }

    public function getActivityTimeline(): array
    {
        return $this->activities()
            ->latest()
            ->get()
            ->groupBy(fn ($activity) => $activity->created_at->format('Y-m-d'))
            ->toArray();
    }
}
