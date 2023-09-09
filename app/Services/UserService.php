<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryContract;

class UserService extends BaseService implements Contracts\UserServiceContract
{
    public function __construct(protected UserRepositoryContract $repository)
    {
        //
    }
}
