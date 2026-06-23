<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

trait HasActivityLog
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->getLoggableAttributes())
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($this->getLogName());
    }

    protected function getLoggableAttributes(): array
    {
        if (property_exists($this, 'loggable')) {
            return $this->loggable;
        }

        return $this->getFillable();
    }

    protected function getLogName(): string
    {
        if (property_exists($this, 'logName')) {
            return $this->logName;
        }

        return class_basename($this);
    }

    public function scopeRecentActivity($query, int $days = 7): void
    {
        $query->whereHas('activities', function ($q) use ($days) {
            $q->where('created_at', '>=', now()->subDays($days));
        });
    }
}
