<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasTenant
{
    public static function bootHasTenant(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->tenant_id) && auth()->check()) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });

        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where($builder->getModel()->getQualifiedTenantColumn(), auth()->user()->tenant_id);
            }
        });
    }

    public function getTenantColumn(): string
    {
        return property_exists($this, 'tenantColumn') ? $this->tenantColumn : 'tenant_id';
    }

    public function getQualifiedTenantColumn(): string
    {
        return $this->getTable() . '.' . $this->getTenantColumn();
    }

    public function scopeByTenant(Builder $query, int $tenantId): Builder
    {
        return $query->withoutGlobalScope('tenant')->where($this->getQualifiedTenantColumn(), $tenantId);
    }

    public function getTenant(): ?Model
    {
        if (!$this->tenant_id) {
            return null;
        }

        $tenantModel = config('tenant.model', 'App\\Models\\Tenant');

        return $tenantModel::find($this->tenant_id);
    }

    public function setTenant(int $tenantId): static
    {
        $this->{$this->getTenantColumn()} = $tenantId;
        $this->save();

        return $this;
    }
}
