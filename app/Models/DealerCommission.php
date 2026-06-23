<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealerCommission extends Model
{
    protected $fillable = [
        'dealer_information_id',
        'order_id',
        'commission_rate',
        'commission_amount',
        'order_amount',
        'status',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'commission_rate' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'order_amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerInformation::class, 'dealer_information_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
