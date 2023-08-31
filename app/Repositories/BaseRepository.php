<?php

namespace App\Repositories;

use App\Commons\CommonConstants;
use App\Repositories\Contracts\BaseRepositoryContract;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository as BaseRepositoryLibrary;

use function App\Commons\coalesce;
use function App\Commons\parseInt;

//use Your Model

/**
 * Class BaseRepository.
 */
abstract class BaseRepository extends BaseRepositoryLibrary implements BaseRepositoryContract
{
    abstract public function getTable();

    public function filter($data = [])
    {
        $model = $this->model;
        $perPage = parseInt(coalesce($data, 'per_page'));
        $perPage = $perPage != false ? $perPage : CommonConstants::DEFAULT_PERPAGE;
        $relations = collect($data)->filter(fn ($_, $name) => preg_match('/^with_/', $name) && method_exists($model, str_replace('with_', '', $name)));
        $relations = $relations->mapWithKeys(fn ($json, $name) => [str_replace('with_', '', $name) => $json]);

        $relations = $relations->mapWithKeys(function ($item, $name) {
            $conditions = collect(json_decode($item));

            return [
                $name => fn ($query) => $query->filter($conditions->toArray())->take(1000)
            ];
        })->toArray();

        $model = $model->with($relations)->filter($data);

        if (coalesce($data, 'is_get_all', false) == 'true') {
            return $model->get();
        }

        return $model->paginate($perPage);
    }

    public function restore($id)
    {
        return $this->model->where('id', $id)->restore();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function forceDelete($id)
    {
        return $this->model->where('id', $id)->forceDelete();
    }
}
