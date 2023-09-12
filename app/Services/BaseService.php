<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property \App\Repositories\Contracts\BaseRepositoryContract $repository
 */
class BaseService implements Contracts\BaseServiceContract
{
    protected $excepts = [
        'id', 'deleted_at',
    ];

    private function getRealData(array|Collection $data)
    {
        return collect($data)->except($this->excepts)->all();
    }

    public function store($attributes)
    {
        return $this->repository->create($this->getRealData($attributes));
    }

    public function update($model, $attributes)
    {
        $attributes = $this->getRealData($attributes);

        if ($model instanceof Model) {
            $model->update($attributes);
            return $model;
        }

        return $this->repository->updateById($model, $attributes);
    }
}
