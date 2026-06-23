<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseReceivingItem extends Model
{
    protected $fillable = [
        'purchase_receiving_id',
        'purchase_order_item_id',
        'product_id',
        'quantity',
        'accepted_quantity',
        'rejected_quantity',
        'rejection_reason',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'accepted_quantity' => 'integer',
            'rejected_quantity' => 'integer',
        ];
    }

    public function purchaseReceiving(): BelongsTo
    {
        return $this->belongsTo(PurchaseReceiving::class);
    }

    public function purchaseOrderItem(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrderItem::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
