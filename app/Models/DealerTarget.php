<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DealerTarget extends Model
{
    protected $fillable = [
        'dealer_information_id',
        'target_amount',
        'achieved_amount',
        'period',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'achieved_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function dealer(): BelongsTo
    {
        return $this->belongsTo(DealerInformation::class, 'dealer_information_id');
    }
}
