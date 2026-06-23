<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'collection_name',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'disk',
        'custom_properties',
        'order_column',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'order_column' => 'integer',
            'custom_properties' => 'array',
        ];
    }

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
