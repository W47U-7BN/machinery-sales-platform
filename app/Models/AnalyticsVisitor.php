<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnalyticsVisitor extends Model
{
    protected $fillable = [
        'visitor_id',
        'ip_address',
        'user_agent',
        'referrer',
        'country',
        'city',
        'browser',
        'platform',
        'device_type',
        'language',
        'first_visit_at',
        'last_visit_at',
        'visit_count',
    ];

    protected function casts(): array
    {
        return [
            'first_visit_at' => 'datetime',
            'last_visit_at' => 'datetime',
            'visit_count' => 'integer',
        ];
    }

    public function pageViews(): HasMany
    {
        return $this->hasMany(AnalyticsPageView::class);
    }
}
