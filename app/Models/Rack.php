<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rack extends Model
{
    protected $fillable = [
        'warehouse_zone_id',
        'name',
        'code',
        'description',
        'max_capacity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'max_capacity' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function warehouseZone(): BelongsTo
    {
        return $this->belongsTo(WarehouseZone::class);
    }
}
