<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadCenter extends Model
{
    protected $table = 'download_center';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'category',
        'is_active',
        'download_count',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'download_count' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
