<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): float
    {
        return round(floatval($value), 2);
    }

    public function set($model, string $key, $value, array $attributes): float
    {
        return round(floatval($value), 2);
    }
}
