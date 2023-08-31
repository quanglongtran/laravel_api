<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;

/**
 * Class PostCategoryRepository.
 */
class PostRepository extends BaseRepository implements PostRepositoryContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Post::class;
    }

    public function getTable()
    {
        return $this->model->getTable();
    }
}
