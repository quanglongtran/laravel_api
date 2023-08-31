<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class AuthRepository extends BaseRepository implements AuthRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
