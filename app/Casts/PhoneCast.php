<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PhoneCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) return null;

        return preg_replace('/[^0-9]/', '', $value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) return null;

        return preg_replace('/[^0-9]/', '', $value);
    }
}
