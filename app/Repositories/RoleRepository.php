<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class RoleRepository extends BaseRepository implements RoleRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Role::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
