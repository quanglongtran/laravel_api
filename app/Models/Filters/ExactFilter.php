<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class ExactFilter extends BaseFilter
{
    protected function apply(Builder $query): Builder
    {
        return $query->where($this->inputName, $this->data[$this->inputName]);
    }
}
