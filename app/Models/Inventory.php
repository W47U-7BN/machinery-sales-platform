<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'rack_id',
        'quantity',
        'min_quantity',
        'max_quantity',
        'minimum_quantity',
        'maximum_quantity',
        'reorder_point',
        'unit_cost',
        'batch_number',
        'expiry_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'min_quantity' => 'integer',
            'max_quantity' => 'integer',
            'minimum_quantity' => 'integer',
            'maximum_quantity' => 'integer',
            'reorder_point' => 'integer',
            'unit_cost' => 'decimal:2',
            'expiry_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function rack(): BelongsTo
    {
        return $this->belongsTo(Rack::class);
    }
}
