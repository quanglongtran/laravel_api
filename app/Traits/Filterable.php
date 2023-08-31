<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

trait Filterable
{
    protected array $filters;

    final public function scopeFilter(Builder $query, array $data = [])
    {
        $this->filters = $data;
        $criteria = method_exists($this, 'getFilters') ? $this->getFilters() : [];

        return (new Pipeline)
            ->send($query)
            ->through($criteria)
            ->thenReturn();
    }
}
