<?php

namespace App\Contracts\Repositories;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function getValue(string $key, mixed $default = null): mixed;

    public function setValue(string $key, mixed $value, string $group = 'general');

    public function getGroup(string $group);
}
