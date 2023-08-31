<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseFilter
{
    public function __construct(protected string $inputName, protected array $data)
    {
        //
    }

    public function handle(Builder $query, \Closure $next)
    {
        if (optional($this->data)[$this->inputName]) {
            $query = $this->apply($query);
        }

        return $next($query);
    }

    abstract protected function apply(Builder $query): Builder;
}
