<?php

namespace App\DTOs;

class AnalyticsData
{
    public function __construct(
        public readonly string $period,
        public readonly array $metrics,
        public readonly array $filters = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            period: $data['period'],
            metrics: $data['metrics'],
            filters: $data['filters'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'period' => $this->period,
            'metrics' => $this->metrics,
            'filters' => $this->filters,
        ];
    }
}
