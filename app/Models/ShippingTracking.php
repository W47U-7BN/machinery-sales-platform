<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingTracking extends Model
{
    protected $table = 'shipping_tracking';

    protected $fillable = [
        'order_id',
        'tracking_number',
        'carrier',
        'status',
        'estimated_delivery_date',
        'delivered_at',
        'current_location',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'estimated_delivery_date' => 'date',
            'delivered_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
