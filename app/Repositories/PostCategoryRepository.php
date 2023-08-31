<?php

namespace App\Repositories;

use App\Models\PostCategory;
use App\Repositories\Contracts\PostCategoryRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class PostCategoryRepository extends BaseRepository implements PostCategoryRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return PostCategory::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
