<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryContract
{
    /**
     * Get table name
     * @return string
     */
    public function getTable();

    /**
     * filter
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function filter(array $data);

    /**
     * find by id
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * find by id
     *
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id);

    /**
     * restore
     *
     * @param  int $id
     * @return bool
     */
    public function restore($id);

    /**
     * force delete
     *
     * @param  int $id
     * @return bool
     */
    public function forceDelete($id);
}
