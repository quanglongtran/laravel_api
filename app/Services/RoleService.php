<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryContract;
use App\Services\Contracts\RoleServiceContract;

class RoleService extends BaseService implements RoleServiceContract
{
    public function __construct(protected RoleRepositoryContract $repository)
    {
        //
    }

    public function givePermissionTo($id, $permissionIds)
    {
        $role = $this->repository->with('permissions')->findOrFail($id);

        return $role->givePermissionTo($permissionIds);
    }

    public function syncPermissions($id, $permissionIds)
    {
        $role = $this->repository->with('permissions')->findOrFail($id);

        return $role->syncPermissions($permissionIds);
    }

    public function revokePermissionTo($id, $permissionIds)
    {
        $role = $this->repository->with('permissions')->findOrFail($id);

        return $role->revokePermissionTo($permissionIds);
    }
}
