<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryOrder extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'delivery_order_number',
        'delivery_date',
        'shipping_address',
        'status',
        'notes',
        'delivered_by',
        'received_by_name',
        'received_at',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'date',
            'received_at' => 'datetime',
            'shipping_address' => 'array',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(DeliveryOrderItem::class);
    }
}
