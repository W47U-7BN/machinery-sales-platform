<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceTicket extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'assigned_to',
        'ticket_number',
        'title',
        'description',
        'priority',
        'status',
        'service_type',
        'warranty_status',
        'reported_at',
        'resolved_at',
        'closed_at',
        'resolution_notes',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'reported_at' => 'datetime',
            'resolved_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(ServiceTicketActivity::class);
    }

    public function spareparts(): HasMany
    {
        return $this->hasMany(ServiceTicketSparepart::class);
    }
}
