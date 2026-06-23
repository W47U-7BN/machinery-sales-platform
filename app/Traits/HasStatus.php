<?php

namespace App\Traits;

use App\Enums\ApprovalStatus;
use Illuminate\Database\Eloquent\Builder;

trait HasStatus
{
    public function getStatusColumn(): string
    {
        return property_exists($this, 'statusColumn') ? $this->statusColumn : 'status';
    }

    public function markAs(string $status): static
    {
        $statusColumn = $this->getStatusColumn();

        $this->{$statusColumn} = $status;

        $timestampColumn = $this->getStatusTimestampColumn($status);

        if ($timestampColumn && $this->isFillable($timestampColumn)) {
            $this->{$timestampColumn} = now();
        }

        $this->save();

        return $this;
    }

    protected function getStatusTimestampColumn(string $status): ?string
    {
        $timestamps = $this->statusTimestamps ?? [];

        return $timestamps[$status] ?? null;
    }

    public function scopeWhereStatus(Builder $query, string $status): Builder
    {
        return $query->where($this->getStatusColumn(), $status);
    }

    public function scopeWhereStatusIn(Builder $query, array $statuses): Builder
    {
        return $query->whereIn($this->getStatusColumn(), $statuses);
    }

    public function scopeWhereStatusNot(Builder $query, string $status): Builder
    {
        return $query->where($this->getStatusColumn(), '!=', $status);
    }

    public function getStatusLabel(): string
    {
        $status = $this->{$this->getStatusColumn()};

        $enum = $this->getStatusEnumClass();

        if ($enum && enum_exists($enum)) {
            return $enum::tryFrom($status)?->label() ?? ucfirst($status);
        }

        return ucfirst(str_replace('_', ' ', $status));
    }

    protected function getStatusEnumClass(): ?string
    {
        return $this->statusEnum ?? null;
    }

    public function isStatus(string $status): bool
    {
        return $this->{$this->getStatusColumn()} === $status;
    }

    public function hasStatus(string ...$statuses): bool
    {
        return in_array($this->{$this->getStatusColumn()}, $statuses, true);
    }
}
