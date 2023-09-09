<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class PostCategoryRepository.
 */
class UserRepository extends BaseRepository implements Contracts\UserRepositoryContract
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
