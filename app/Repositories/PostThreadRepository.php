<?php

namespace App\Repositories;

use App\Models\PostThread;
use App\Repositories\Contracts\PostThreadRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class PostThreadRepository extends BaseRepository implements PostThreadRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return PostThread::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
