<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DealerInformation extends Model
{
    protected $table = 'dealer_information';

    protected $fillable = [
        'user_id',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'tax_id',
        'license_number',
        'website',
        'dealer_type',
        'status',
        'commission_rate',
        'notes',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'commission_rate' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(DealerProduct::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(DealerCommission::class);
    }

    public function targets(): HasMany
    {
        return $this->hasMany(DealerTarget::class);
    }
}
