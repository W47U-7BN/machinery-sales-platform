<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class JsonCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): mixed
    {
        if (is_null($value)) return null;
        if (is_array($value)) return $value;
        return json_decode($value, true) ?? [];
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        if (is_null($value)) return '{}';
        if (is_string($value)) return $value;
        return json_encode($value);
    }
}
