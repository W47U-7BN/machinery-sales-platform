<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentManagement extends Model
{
    protected $table = 'document_management';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'category',
        'tags',
        'version',
        'is_public',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'version' => 'integer',
            'tags' => 'array',
            'is_public' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
