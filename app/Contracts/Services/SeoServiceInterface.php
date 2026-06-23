<?php

namespace App\Contracts\Services;

interface SeoServiceInterface
{
    public function updateSeo(int $modelId, string $modelType, array $data);

    public function getSeoForModel(int $modelId, string $modelType);

    public function generateSchemaMarkup(string $type, mixed $model);
}
