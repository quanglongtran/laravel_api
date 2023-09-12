<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryContract;

class PermissionService extends BaseService implements Contracts\PermissionServiceContract
{
    public function __construct(protected RoleRepositoryContract $repository)
    {
        //
    }
}
