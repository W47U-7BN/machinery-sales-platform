<?php

namespace App\Repositories;

use App\Contracts\Repositories\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getValue(string $key, mixed $default = null): mixed
    {
        try {
            $cacheKey = "setting.{$key}";

            return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
                $setting = $this->newQuery()->where('key', $key)->first();

                return $setting ? $setting->value : $default;
            });
        } catch (\Throwable $e) {
            Log::error('SettingRepository getValue() error: ' . $e->getMessage(), [
                'key' => $key,
            ]);

            return $default;
        }
    }

    public function setValue(string $key, mixed $value, string $group = 'general')
    {
        try {
            $setting = $this->newQuery()->updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );

            Cache::forget("setting.{$key}");

            return $setting;
        } catch (\Throwable $e) {
            Log::error('SettingRepository setValue() error: ' . $e->getMessage(), [
                'key' => $key,
                'group' => $group,
            ]);
            throw $e;
        }
    }

    public function getGroup(string $group)
    {
        try {
            return $this->newQuery()
                ->where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        } catch (\Throwable $e) {
            Log::error('SettingRepository getGroup() error: ' . $e->getMessage(), [
                'group' => $group,
            ]);
            throw $e;
        }
    }
}
