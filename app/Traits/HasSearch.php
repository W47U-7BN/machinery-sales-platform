<?php

namespace App\Traits;

use Laravel\Scout\Searchable;

trait HasSearch
{
    use Searchable;

    public function toSearchableArray(): array
    {
        $searchableFields = $this->getSearchableFields();

        $array = [];

        foreach ($searchableFields as $field) {
            $array[$field] = $this->{$field};
        }

        $array['id'] = $this->id;
        $array['created_at'] = $this->created_at?->timestamp;

        return $array;
    }

    protected function getSearchableFields(): array
    {
        if (property_exists($this, 'searchableFields')) {
            return $this->searchableFields;
        }

        return $this->getFillable();
    }

    public function shouldBeSearchable(): bool
    {
        $searchableCondition = $this->searchableCondition ?? null;

        if ($searchableCondition === null) {
            return true;
        }

        if (is_callable($searchableCondition)) {
            return ($searchableCondition)($this);
        }

        if (method_exists($this, $searchableCondition)) {
            return $this->{$searchableCondition}();
        }

        return (bool) $this->{$searchableCondition};
    }
}
