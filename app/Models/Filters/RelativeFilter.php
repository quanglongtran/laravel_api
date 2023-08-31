<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

class RelativeFilter extends BaseFilter
{
    protected function apply(Builder $query): Builder
    {
        $keyword = '\\' . addslashes($this->data[$this->inputName]);

        return $query->where($this->inputName, 'like', "%$keyword%");
    }
}
