<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class PermissionRepository extends BaseRepository implements PermissionRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Permission::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
