<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalyticsPageView extends Model
{
    protected $fillable = [
        'analytics_visitor_id',
        'url',
        'page_title',
        'time_spent',
        'viewed_at',
    ];

    protected function casts(): array
    {
        return [
            'time_spent' => 'integer',
            'viewed_at' => 'datetime',
        ];
    }

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(AnalyticsVisitor::class, 'analytics_visitor_id');
    }
}
