<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseServiceContract
{
    /**
     * bla bla
     * 
     * @param array|Collection $attributes
     * @return Model
     */
    public function store($attributes);

    /**
     * bla bla
     * 
     * @param int|Model $model Id or instance of model
     * @param array|Collection $attributes
     * @return Model
     */
    public function update($model, $attributes);
}
