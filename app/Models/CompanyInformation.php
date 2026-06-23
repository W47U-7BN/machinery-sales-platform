<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    protected $table = 'company_information';

    protected $fillable = [
        'company_name',
        'company_legal_name',
        'tagline',
        'description',
        'logo',
        'favicon',
        'email',
        'phone',
        'alternative_phone',
        'whatsapp',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'tax_id',
        'registration_number',
        'founded_year',
        'employee_count',
        'social_media',
        'working_hours',
        'about_us',
        'vision',
        'mission',
        'values',
        'map_embed_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'social_media' => 'array',
            'working_hours' => 'array',
            'founded_year' => 'integer',
            'employee_count' => 'integer',
        ];
    }
}
