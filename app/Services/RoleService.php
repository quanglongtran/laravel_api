<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\RoleServiceContract;

class RoleService extends BaseService implements RoleServiceContract
{
    public function __construct(protected RoleRepositoryContract $repository)
    {
        //
    }

    public function givePermissionTo($model, $permissionNames)
    {
        return tap(
            $model instanceof Role ? $model : $this->repository->findOrFail($model),
            fn ($role) => $role->givePermissionTo($permissionNames)
        );
    }

    public function syncPermissions($model, $permissionNames)
    {
        return tap(
            $model instanceof Role ? $model : $this->repository->findOrFail($model),
            fn ($role) => $role->syncPermissions($permissionNames)
        );
    }

    public function revokePermissionTo($model, $permissionNames)
    {
        return tap(
            $model instanceof Role ? $model : $this->repository->findOrFail($model),
            fn ($role) => $role->revokePermissionTo($permissionNames)
        );
    }
}
